<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Response;

use Mvc\Domain\Disease;

class DiseaseFindersResponse
{
    /** @var Disease */
    private $disease;

    public function __construct(
        Disease $disease
    ) {
        $this->disease = $disease;
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->disease->getId(),
            'name' => $this->disease->getName(),
            'description' => $this->disease->getDescription()
        ];
        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }
}
