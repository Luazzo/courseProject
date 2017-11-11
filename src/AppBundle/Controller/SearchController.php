<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Provider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Search controller.
 *
 * @Route("search")
 */
class SearchController extends Controller
{
    /**
     * List of found Providers
     * @Method("GET")
     * @Route("/providers", name="search_providers")
     */
    public function getProvidersAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $data = $request -> query -> get('appbundle_search');

        $providers=$this->get('AppBundle\Services\Search')->providersSearch($data['keyword'],$data['category'],$data['locality']);

        $paginate  = $this->get('knp_paginator')->paginate(
            $providers,
            $request->query->get('page', 1), 3);


        return $this->render('/provider/index.html.twig', array('providers' => $providers, 'paginate' => $paginate));

    }
}