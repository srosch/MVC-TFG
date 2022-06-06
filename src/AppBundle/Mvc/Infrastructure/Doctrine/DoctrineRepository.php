<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Query\Builder;

abstract class DoctrineRepository
{
    /** @var ObjectManager */
    protected $manager;
    /** @var DocumentManager */
    protected $documentManager;

    public function __construct(ObjectManager $manager, DocumentManager $documentManager)
    {
        $this->manager = $manager;
        $this->documentManager = $documentManager;
    }

    abstract protected function repositoryClassName(): string;

    protected function builder(): Builder
    {
        return $this->documentManager->createQueryBuilder($this->repositoryClassName());
    }

    protected function repository(): ObjectRepository
    {
        return $this->manager->getRepository($this->repositoryClassName());
    }
}
