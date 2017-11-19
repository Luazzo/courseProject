<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em-> getRepository("AppBundle:Category")->findAll();
        $courses = $em-> getRepository("AppBundle:Course")->coursesIndex(3);
        $promotions = $em-> getRepository("AppBundle:Promotion")->findAll();
        $comments = $em-> getRepository("AppBundle:Comment")->newComments(6);
        $towns = $em-> getRepository("AppBundle:Town")->findAll();

        return $this->render("Annuaire/index.html.twig",array(
            "towns" => $towns,
            "comments"=>$comments,
            "categories"=>$categories,
            "courses"=>$courses,
            "promotions"=>$promotions
        ));
    }


    public  function searchFormHorizontalAction(){
        $form = $this->createForm('AppBundle\Form\SearchType',null,array(
            'action' => $this->generateUrl('search_providers'),
            'method' => 'GET'
        ));

        return $this->render(':Partials:search-form-horizontal.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public  function searchFormAction(){
        $form = $this->createForm('AppBundle\Form\SearchType',null,array(
            'action' => $this->generateUrl('search_providers'),
            'method' => 'GET'
        ));

        return $this->render('search/search-form-test.html.twig', array(
            'form' => $form->createView()
        ));
    }





}
