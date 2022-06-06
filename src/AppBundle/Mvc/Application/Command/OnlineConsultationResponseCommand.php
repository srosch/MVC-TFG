<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class OnlineConsultationResponseCommand implements Command
{
    /** @var string */
    private $userId;
    /** @var string */
    private $date;
    /** @var string */
    private $onlineConsultationId;
    /** @var string */
    private $text;

    public function __construct(
        string $userId,
        string $onlineConsultationId,
        string $date,
        string $text
    ) {
        $this->userId = $userId;
        $this->onlineConsultationId = $onlineConsultationId;
        $this->date = $date;
        $this->text = $text;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function onlineConsultationId(): string
    {
        return $this->onlineConsultationId;
    }

    public function date(): string
    {
        return $this->date;
    }

    public function text(): string
    {
        return $this->text;
    }
}
