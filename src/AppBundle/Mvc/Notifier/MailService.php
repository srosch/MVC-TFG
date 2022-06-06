<?php

namespace AppBundle\Mvc\Notifier;

use Swift_Attachment;
use Swift_Mailer;
use Swift_Message;

class MailService
{

    /** @var Swift_Mailer */
    private $mailer;
    /** @var string */
    private $mailFrom;
    /** @var bool */
    private $isProduction;
    /** @var string */
    private $developerEmail;

    public function __construct(
        Swift_Mailer $mailer,
        string $mailFrom,
        bool $isProduction,
        string $developerEmail
    ) {
        $this->mailer = $mailer;
        $this->mailFrom = $mailFrom;
        $this->isProduction = $isProduction;
        $this->developerEmail = $developerEmail;
    }

    /**
     * Send email
     */
    public function sendEmail(
        string $fromName,
        string $to,
        string $subject,
        string $htmlText,
        $attach = null
    ): int {
        $message = $this->buildMessage($fromName, $to, $subject, $htmlText, $attach);
        $sended = $this->mailer->send($message);
        if (!$this->isProduction) {
            $messageToDeveloper = $this->buildMessage(
                $fromName,
                $this->developerEmail,
                'Replay: ' . $subject,
                $htmlText,
                $attach
            );
            $this->mailer->send($messageToDeveloper);
        }
        return $sended;
    }


    private function buildMessage(
        string $fromName,
        string $to,
        string $subject,
        string $htmlText,
        $attach
    ): Swift_Message {
        $message = new Swift_Message($subject);
        $message->setFrom([$this->mailFrom => $fromName]);
        $message->setTo($to);
        $message->setBody($this->compressHtml($htmlText), 'text/html');
        if (!is_null($attach)) {
            $message->attach(Swift_Attachment::fromPath($attach));
        }
        return $message;
    }

    private function compressHtml(string $html): string
    {
        $search = array(
            '/\>[^\S ]+/s',//strip whitespaces after tags, except space
            '/[^\S ]+\</s',//strip whitespaces before tags, except space
            '/(\s)+/s',//shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/'// Remove HTML comments
        );
        $replace = array('>','<','\\1','');
        $html = preg_replace($search, $replace, $html);
        return $html;
    }
}
