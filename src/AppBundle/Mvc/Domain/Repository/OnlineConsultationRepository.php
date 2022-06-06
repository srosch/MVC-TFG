<?php

declare(strict_types=1);

namespace Mvc\Domain\Repository;

use Mvc\Domain\OnlineConsultation;

interface OnlineConsultationRepository
{
    /** @return OnlineConsultation[] */
    public function findAllByUserId(string $id): array;

    /** @return OnlineConsultation[] */
    public function findPending(): array;

    public function find(string $id): OnlineConsultation;

    public function save(OnlineConsultation $onlineConsultation): void;

    public function update(OnlineConsultation $onlineConsultation): void;

    public function remove(OnlineConsultation $onlineConsultation): void;
}
