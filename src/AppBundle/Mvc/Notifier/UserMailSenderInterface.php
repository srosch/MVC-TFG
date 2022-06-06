<?php

declare(strict_types=1);

namespace Mvc\Notifier;

interface UserMailSenderInterface
{
    public function sendEmailOnlineConsultation(
        string $userEmail,
        string $name
    ): void;

    public function sendEmailAddDocument(
        string $email,
        string $name
    ): void;
}
