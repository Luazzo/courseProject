<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Member;
use AppBundle\Entity\Provider;
use AppBundle\Entity\UserTemp;
use AppBundle\Form\UserTempType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;

class RegistrationTempController extends Controller
{

    public function tokenCheckAction($token)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->verifToken($token);
        dump($user);die();

        if($user)
        {
            $user->setToken("null");
            $user->setEnable(1);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('login');
        }


        return $user;
    }




    /**
     * @Route("/register_confirm/{token}", name="register_confirm")
     * @Method("GET")
     */
    public function registerConfirmAction($token)
    {
        dump("confirmé"); die();

        if($token !== null)
        {
            $user = $this -> tokenCheckAction($token);

            if($user !== null)
            {
                $this->enableUserAction($token);
            }

            return $this->redirectToRoute('login', array('user' => $user));
        }
    }


    /**
     * @Route("/confirmation_request", name="demande_confirmation")
     */
    public function demandeConfirmationAction()
    {
        return $this->render('register/demande-confirmation.html.twig', array());
    }


    public function genToken($length)
    {
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)),0, $length);
    }



    /**
     * @param Request $request
     * @Route("/register", name="register")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerAction(Request $request)
    {

        $user = new UserTemp();

        $form = $this->createForm('AppBundle\Form\UserTempType', $user);

        if ($this->handleFormRegister($request, $form, $user)==true){ //without $user password not generated correctly
            return $this->redirectToRoute('demande_confirmation');
        }

        return $this->render(
            'register/register.html.twig',
            array('form' => $form->createView())
        );
    }


    /**
     * @param Request $request
     * @Route("/handleFormRegister", name="handleFormRegister")
     * @return \Symfony\Component\HttpFoundation\Response | \Symfony\Component\HttpFoundation\RedirectResponse
     * @Method("POST")
     * @throws \LogicException
     * @throws \InvalidArgumentException
     */
    public function handleFormRegister(Request $request, $form, $user)
    {

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $role = $form["role"]->getData();
            if ($role == 'ROLE_PROVIDER') {
                $userReg = new Provider();
            } elseif ($role == 'ROLE_MEMBER') {
                $userReg = new Member();
            }

            $userReg->setRole($role);

            $username = $form["username"]->getData();
            $userReg->setUsername($username);

            $usermail = $form["email"]->getData();
            $userReg->setEmail($usermail);

            $password = $this
                ->get('security.password_encoder')
                ->encodePassword(
                    $user,
                    $user->getPlainPassword()
                );
            $userReg->setPassword($password);

            $token = $this->genToken(60);

            $userReg->setToken($token);       //$token = bin2hex(random_bytes(16)); - PHP7

            $em = $this->getDoctrine()->getManager();
            $em->persist($userReg);
            $em->flush();

            $this->get('AppBundle\Services\SendMail')->sendConfirmation($usermail, $username, $token);

            return true; //Without TRUE - function registerAction return render('register/register.html.twig')
                                //  and not gotoRoute "demande_confirmation"
        }
    }

}