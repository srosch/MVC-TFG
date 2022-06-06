<?php

declare(strict_types=1);

namespace Mvc\Notifier;


use AppBundle\Mvc\Exceptions\SendMailException;
use AppBundle\Mvc\Notifier\MailService;
use Prophecy\Exception\Exception;
use Twig\Environment;

class UserMailSender implements UserMailSenderInterface
{
    /** @var MailService */
    private $mailService;

    public function __construct(
        MailService $mailService,
        Environment $template
    ) {
        $this->template = $template;
        $this->mailService = $mailService;
    }

    /** @throws SendMailException */
    public function sendEmailOnlineConsultation(string $email, string $name): void
    {
        $body = "Hola " . $name . ", se ha contestado a tu consulta online.";
        try {
            $sent = $this->mailService->sendEmail('MVC', $email, 'Response online consultation', $body);
            if (!$sent) {
                throw new SendMailException([
                    'email' => $email
                ]);
            }
        } catch (Exception $e) {
            throw new SendMailException([
                'email' => $email
            ]);
        }
    }

    /** @throws SendMailException */
    public function sendEmailAddDocument(string $email, string $name): void
    {
        $body = "Hola " . $name . ", se ha añadido un nuevo documento/receta.";
        try {
            $sent = $this->mailService->sendEmail('MVC', $email, 'New Document', $body);
            if (!$sent) {
                throw new SendMailException([
                    'email' => $email
                ]);
            }
        } catch (Exception $e) {
            throw new SendMailException([
                'email' => $email
            ]);
        }
    }
}
