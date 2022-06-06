<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Response;

use Mvc\Domain\UserDocument;

class UserDocumentFindersResponse
{
    /** @var UserDocument */
    private $userDocument;

    public function __construct(
        UserDocument $userDocument
    ) {
        $this->userDocument = $userDocument;
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->userDocument->getId(),
            'name' => $this->userDocument->getName(),
            'base64' => $this->userDocument->getBase64(),
            'type' => $this->userDocument->getType(),
            'date' => $this->userDocument->getDate(),
            'notes' => $this->userDocument->getNotes()
        ];
        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }
}
