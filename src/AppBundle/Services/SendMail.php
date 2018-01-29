<?php
namespace AppBundle\Services;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class SendMail{

    protected $mailer;

    protected $templating;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;

        $this->templating = $templating;
    }



    public function sendConfirmation($email)
    {
        $template = 'AppBundle:Mail:register_confirmation.html.twig';

        $from = 'admin@wellbeing.com';

        $to = $email;

        $subject = 'Confirmation instructions';

        $body = $this->templating->render($template, array('contact' => $email));

        $this->sendMessage($from, $to, $subject, $body);

        return "ok message!";
    }



    protected function sendMessage($from, $to, $subject, $body)
    {
        $mail = \Swift_Message::newInstance();

        $mail
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setContentType('text/html');

        $this->mailer->send($mail);
    }
}

