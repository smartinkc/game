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

class PlayController extends Controller
{
    	/**
     	* @Route("/start")
     	*/
    	public function startAction()
    	{
		return $this->render('play/start.html.twig', []);
    	}

	/**
	* @Route("/winner")
	* @Method({"POST"})
	*/
	public function winner(){
		var_dump(session_id());die;
		
		$myChoice = @$_POST["myChoice"];
		$computerChoice = @$_POST["computerChoice"];

		if($myChoice == $computerChoice){
			return new Response(-1);
		}
		else{
			$em = $this->getDoctrine()->getManager();

			$choice = $em->getRepository('AppBundle:Winner')
                        	->findOneBy(array('choiceId' => $myChoice));

			$tmp = explode(',', $choice->getChoiceLose());

			if(in_array($computerChoice, $tmp)){
				return new Response(0);
			}
			else{
				return new Response(1);
			}
		}
	}

	/**
	* @Route("/getChoices")
	*/
	public function getChoices(){
		$em = $this->getDoctrine()->getManager();
        	
		$choices = $em->getRepository('AppBundle:Choices')
            		->findAll( );

		$serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new JsonEncoder()));
		$json = json_decode($serializer->serialize($choices, 'json'));

		return new JsonResponse($json);
	}

	/**
	* @Route("/computerPick")
	*/
	public function computerPick(){
		sleep(1);

		return new Response(rand(1, 5));
	}
}
