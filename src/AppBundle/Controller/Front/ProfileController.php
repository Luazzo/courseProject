<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Member;
use AppBundle\Entity\Provider;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;




/**
 * Provider controller.
 *
 * @Route("profile")
 */
class ProfileController extends Controller
{
    /**
     * @Route("/update", name="update_profile")
     * @Method({"POST","GET"})
     */
    public function updateProfileAction(Request $request, $user)
    {

        if($user != null){
            if($user instanceof Provider){
                $type='AppBundle\Form\Front\ProviderType';
                $view=':public/profile:provider.html.twig';

            }elseif($user instanceof Member){
                $type='AppBundle\Form\Front\MemberType';
                $view=':public/profile:member.html.twig';
            }

            $form = $this->createForm($type, $user);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $em=$this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute("login");
            }
            return $this->render($view, [
                'form'=>$form->createView(),
                'user'=>$user
                ]);

        }

    }



}