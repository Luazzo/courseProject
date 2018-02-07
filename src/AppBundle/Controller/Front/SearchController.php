<?php
namespace AppBundle\Controller\Front;

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

        $data = $request -> query -> get('appbundle_search');

        $listProviders=$this->get('AppBundle\Services\Search')->providersSearch($data['keyword'],$data['category'],$data['locality']);

        $providers  = $this->get('knp_paginator')->paginate(
            $listProviders,
            $request->query->get('page', 1),
            3);

        //dump($paginate); die();

        return $this->render('front/provider/index.html.twig', array(
            'providers' => $providers
        ));

    }
}