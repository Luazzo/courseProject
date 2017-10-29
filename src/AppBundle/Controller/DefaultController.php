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

        return $this->render("Annuaire/index.html.twig",array("comments"=>$comments, "categories"=>$categories, "courses"=>$courses,"promotions"=>$promotions ));

    }





}
