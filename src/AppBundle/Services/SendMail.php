<?php
namespace AppBundle\Services;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Swift_Mailer;
use Swift_Message;
use Doctrine\ORM\EntityManager;


class SendMail{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    protected $mailer;

    protected $templating;

    public function __construct(EntityManager $em, Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->entityManager = $em;

        $this->mailer = $mailer;

        $this->templating = $templating;
    }



    public function sendConfirmation($email, $username, $token)
    {
        $template = 'Mail/register_confirmation.html.twig';

        $from = 'admin@wellbeing.com';

        $to = $email;

        $subject = 'Confirmation instructions';

        $link = "http://127.0.0.1:8000/register_confirm/".$token;

        $body = $this->templating->render($template, array(
            'contact' => $username,
            'url_site' => $link
            ));

        $this->sendMessage($from, $to, $subject, $body);

        //return "ok message!";
    }



    protected function sendMessage($from, $to, $subject, $body)
    {
        $mail = Swift_Message::newInstance();

        $mail
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setContentType('text/html');

        $this->mailer->send($mail);
    }
}

