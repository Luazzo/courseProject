<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Provider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provider controller.
 *
 * @Route("provider")
 */
class ProviderController extends Controller
{


    /**
     * Lists all provider entities.
     *
     * @Route("/", name="provider_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $providers = $em->getRepository('AppBundle:Provider')->bestProviders(5);

        return $this->render('front/provider/index.html.twig', array(
            'providers' => $providers,
        ));
    }

    /**
     * Creates a new provider entity.
     *
     * @Route("/new", name="provider_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $provider = new Provider();
        $form = $this->createForm('AppBundle\Form\Front\ProviderType', $provider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($provider);
            $em->flush();

            return $this->redirectToRoute('provider_show', array('id' => $provider->getId()));
        }

        return $this->render('front/provider/new.html.twig', array(
            'provider' => $provider,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a provider entity.
     *
     * @Route("/{slug}", name="provider_show")
     * @Method("GET")
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $provider = $em->getRepository('AppBundle:Provider')->findOneBySlug($slug);

        $rating = $em->getRepository('AppBundle:Rating')->findRating($provider);

        $hearts = $em->getRepository('AppBundle:Favorite')->findHearts($provider);

        $deleteForm = $this->createDeleteForm($provider);

        return $this->render('front/provider/show.html.twig', array(
            'rating' => $rating,
            'hearts' => $hearts,
            'provider' => $provider,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing provider entity.
     *
     * @Route("/{slug}/edit", name="provider_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Provider $provider)
    {
        $deleteForm = $this->createDeleteForm($provider);
        $editForm = $this->createForm('AppBundle\Form\Front\ProviderType', $provider);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('provider_edit', array('id' => $provider->getId()));
        }

        return $this->render('front/provider/edit.html.twig', array(
            'provider' => $provider,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a provider entity.
     *
     * @Route("/{slug}", name="provider_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $provider = $em->getRepository('AppBundle:Provider')->findOneBySlug($slug);

        $form = $this->createDeleteForm($provider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($provider);
            $em->flush();
        }

        return $this->redirectToRoute('provider_index');
    }

    /**
     * Creates a form to delete a provider entity.
     *
     * @param Provider $provider The provider entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Provider $provider)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('provider_delete', array('slug' => $provider->getSlug())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    public function getBestProvidersAction($max)
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Provider');

        $bestProviders = $repository->bestProviders($max);


        return $this->render("front/provider/card-wrapper.html.twig",array("providers"=>$bestProviders ));

    }
}
