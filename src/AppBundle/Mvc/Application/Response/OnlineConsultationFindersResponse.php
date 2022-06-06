<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Response;

use Mvc\Domain\ResponseOnlineConsultation;
use Mvc\Domain\OnlineConsultation;

class OnlineConsultationFindersResponse
{
    /** @var OnlineConsultation */
    private $onlineConsultation;

    public function __construct(
        OnlineConsultation $onlineConsultation
    ) {
        $this->onlineConsultation = $onlineConsultation;
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->onlineConsultation->getId(),
            'patient' => [
                'id' =>  $this->onlineConsultation->getPatient()->getId(),
                'name' =>  $this->onlineConsultation->getPatient()->getName(),
                'firstLastName' =>  $this->onlineConsultation->getPatient()->getFirstLastName()
            ],
            'date' => $this->onlineConsultation->getDate(),
            'text' => $this->onlineConsultation->getText(),
            'response' => is_null($this->onlineConsultation->getResponse()) ? null
                : $this->response($this->onlineConsultation->getResponse())
        ];
        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }

    private function response(ResponseOnlineConsultation $response): array
    {
        $result = [
            'date' => $response->getDate(),
            'text' => $response->getText(),
            'healthPersonnel' => [
                'id' => $response->getHealthPersonnel()->getId(),
                'name' => $response->getHealthPersonnel()->getName(),
                'firstLastName' => $response->getHealthPersonnel()->getFirstLastName()
            ]
        ];

        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }
}
