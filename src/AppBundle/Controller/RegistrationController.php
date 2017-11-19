<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Member;
use AppBundle\Entity\Provider;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class RegistrationController extends Controller
{

    /**
     * @Route("/confirmation_message", name="demande_confirmation")
     */
    public function demandeConfirmationAction()
    {

        return $this->render('register/demande-confirmation.html.twig', array());

    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {

        return $this->render('register/login.html.twig', array());

    }



    /**
     * @Route("/register", name="register")
     * @Method({"GET", "POST"})
     */
    public function registerAction(Request $request, UserInterface $passwordEncoder)
    {

        // 1) build the form
        $user = new User();
        $form = $this->createForm('AppBundle\Form\UserType', $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $role = $form["role"]->getData();
            if($role == 'ROLE_PROVIDER'){
                $userReg = new Provider();
            }elseif ($role == 'ROLE_MEMBER'){
                $userReg = new Member();
            }

            $userReg->setRole($role);

            $username = $form["username"]->getData();
            $userReg->setUsername($username);

            $usermail = $form["email"]->getData();
            $userReg->setEmail($usermail);

            //$password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());

            // 3) Encode the password (you could also do this via Doctrine listener):
            $password = $this
                ->get('security.password_encoder')
                ->encodePassword(
                    $userReg,
                    $userReg->getPlainPassword()
                );
            $userReg->setPassword($password);


            //dump($userType); // montre le type qu'il faut

            //$user->setUserType($userType);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($userReg);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            //$this->addFlash('success', 'You are now successfuly registered!');


            return $this->redirectToRoute('demande_confirmation');
        }

        return $this->render(
            'register/register.html.twig',
            array('form' => $form->createView())
        );
    }
}