<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use AppBundle\Entity\Games;

class PlayController extends Controller
{
    /**
     * Default Method
     *
     * @Route("/start")
     */
    public function startAction()
    {
        if(!isset($_COOKIE["PHPSESSID"])){
            session_start();
        }

        return $this->render('play/start.html.twig', []);
    }

    /**
     * Determines winner based upon POST variables
     * Database base determines if $myChoice loses to $computerChoice
     *
     * @Route("/winner")
     * @Method({"POST"})
     */
    public function winner()
    {
        $myChoice = @$_POST["myChoice"];
        $computerChoice = @$_POST["computerChoice"];

        $status = -1;

        if($myChoice == $computerChoice){
            $status = -1;
        }
        else{
            $em = $this->getDoctrine()->getManager();

            $choice = $em->getRepository('AppBundle:Winner')
                ->findOneBy(array('choiceId' => $myChoice));

            $tmp = explode(',', $choice->getChoiceLose());

            if(in_array($computerChoice, $tmp)){
                $status = 0;
            }
            else{
                $status = 1;
            }
        }

        //save game to database
        $game = new Games();
        $game->setSession(session_id());
        $game->setWinner($status);
        $game->setUserChoice($myChoice);
        $game->setComputerChoice($computerChoice);
        $em = $this->getDoctrine()->getManager();
        $em->persist($game);
        $em->flush();

        return new Response($status);
    }

    /**
     * Returns JSON data of win and draw totals
     *
     * @Route("/getScore")
     */
    public function getScore()
    {
        $em = $this->getDoctrine()->getManager();

        $score = $em->getRepository('AppBundle:Games')
            ->getScoreBySession();

        return new JsonResponse($score);
    }

    /**
     * Returns choice totals by player by choice
     *
     * @Route("/getUserChoices")
     */
    public function getUserChoices()
    {
        $em = $this->getDoctrine()->getManager();

        $score = $em->getRepository('AppBundle:Games')
            ->getChoicesByUser();

        return new JsonResponse($score);
    }

    /**
     * Returns available choices (rock, paper, etc.) from database
     *
     * @Route("/getChoices")
     */
    public function getChoices()
    {
        $em = $this->getDoctrine()->getManager();

        $choices = $em->getRepository('AppBundle:Choices')
            ->findAll( );

        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new JsonEncoder()));
        $json = json_decode($serializer->serialize($choices, 'json'));

        return new JsonResponse($json);
    }

    /**
     * Returns a random number between 1 and 5
     *
     * @Route("/computerPick")
     */
    public function computerPick()
    {
        sleep(1);

        return new Response(rand(1, 5));
    }
}
