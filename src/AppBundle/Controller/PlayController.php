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
