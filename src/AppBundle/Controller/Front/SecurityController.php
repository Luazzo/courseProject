<?php
namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AppBundle\Entity\Member;
use AppBundle\Entity\Provider;
use AppBundle\Entity\Usertemp;
use AppBundle\Entity\User;
use AppBundle\Form\UsertempType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;


class SecurityController extends Controller
{

    /**
     * @Route("/login", name="login")
     */

public function login(Request $request, AuthenticationUtils $authUtils)
{
    // get the login error if there is one
    $error = $authUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authUtils->getLastUsername();

    return $this->render('front/security/login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
}

    /**
     * @Method({"POST"})
     * @Route("/login_check", name="login_check")
     */
    public function check()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    /**
     * @Method({"GET"})
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }

        /**
     * @Route("/register_confirm/{token}", name="register_confirm")
     * @Method({"GET","POST"})
     */
    public function registerConfirmAction($token)
    {
        $em = $this->getDoctrine()->getManager();

        $userTemp = $em->getRepository('AppBundle:Usertemp')->findOneBy(["token"=>$token]);


        if($userTemp){

            $user = null;
            if($userTemp -> getType() == User::TYPE_MEMBER  )
            {
                $user = new Member();
            }
            elseif($userTemp -> getType() == User::TYPE_PROVIDER)
            {
                $user = new Provider();
            }
            $user->setUsername($userTemp->getName());
            $user->setPassword($userTemp->getPassword());
            $user->setEmail($userTemp->getEmail());
            $user->setRegistration($userTemp->getDate());


            //$this->addFlash('notice','Veillez vous identifier');
            return $this->forward('AppBundle\Controller\Front\ProfileController::updateProfileAction',
            array(
                'user' => $user
            ));
        }
        else{
            throw new NotFoundHttpException('Token n\'est pas trouvé');
        }

        //dump($user);die();


    }


    /**
     * @Route("/confirmation_request", name="demande_confirmation")
     */
    public function demandeConfirmationAction()
    {
        return $this->render('front/security/demande-confirmation.html.twig', array());
    }




    /**
     * @param Request $request
     * @Route("/register", name="register")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerAction(Request $request, EncoderFactoryInterface $encoderFactory)
    {

        $user = new Usertemp();

        $form = $this->createForm('AppBundle\Form\Front\UsertempType', $user);

        if ($this->handleFormRegister($request, $form, $user, $encoderFactory)==true){ //without $user password not generated correctly
            return $this->redirectToRoute('demande_confirmation');
        }

        return $this->render(
            'front/security/register.html.twig',
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
    public function handleFormRegister(Request $request, $form, $user, EncoderFactoryInterface $encoderFactory){

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user-> setDate(new \DateTime());

            $token = bin2hex(random_bytes(16));
            $user->setToken($token);     //bin2hex(random_bytes(16)); //- PHP7

            $type = $form["type"]->getData();
            $user->setType($type);

            $username = $form["name"]->getData();
            $user->setName($username);

            $usermail = $form["email"]->getData();
            $user->setEmail($usermail);

            $password = $form->getData()->getPlainPassword();
            $user->setPassword(
                $encoderFactory->getEncoder($user)->encodePassword($password,'')
            );

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->get('AppBundle\Services\SendMail')->sendConfirmation($usermail, $username, $token);

            return true; //Without TRUE - function registerAction return render('register/register.html.twig')
                                //  and not gotoRoute "demande_confirmation"
        }
    }
}