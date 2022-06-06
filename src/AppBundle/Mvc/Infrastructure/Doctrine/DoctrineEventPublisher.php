<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ODM\MongoDB\DocumentManager;
use Mvc\Infrastructure\CQRS\Event\EventHandler;
use Mvc\Infrastructure\CQRS\Event\EventNotPublishedException;
use Mvc\Infrastructure\CQRS\Event\EventPublisher;
use Mvc\Infrastructure\CQRS\Event\Event;
use Mvc\Infrastructure\CQRS\Event\JSONMessageSerializer;
use Throwable;

use Mvc\Infrastructure\Doctrine\Document\DoctrineEvent;

class DoctrineEventPublisher extends DoctrineRepository implements EventPublisher, EventHandler
{
    /** @var JSONMessageSerializer $jsonMessageSerializer */
    private $jsonMessageSerializer;

    public function __construct(
        ObjectManager $manager,
        DocumentManager $documentManager,
        JSONMessageSerializer $jsonMessageSerializer
    ) {
        parent::__construct($manager, $documentManager);
        $this->jsonMessageSerializer = $jsonMessageSerializer;
    }


    /** @throws Throwable */
    public function publish(Event ...$events): void
    {
        foreach ($events as $event) {
            $this->save($event);
        }
    }

    /** @throws EventNotPublishedException */
    private function save(Event $event): void
    {
        $dataDecoded = $this->jsonDecodeEvent($event);

        $eventDoctrine = $this->makeData($dataDecoded);
        try {
            $this->documentManager->persist($eventDoctrine);
            $this->documentManager->flush($eventDoctrine);
        } catch (Throwable $err) {
            throw new EventNotPublishedException(['event' => $event->getAttributes()], $err);
        }
    }

    private function jsonDecodeEvent(Event ...$events): array
    {
        return (array)json_decode($this->jsonMessageSerializer->serialize(...$events), true);
    }

    private function makeData(array $dataDecoded): DoctrineEvent
    {
        return new DoctrineEvent(
            $dataDecoded['id'],
            (int)$dataDecoded['occurredOn'],
            $dataDecoded['meta']['message'],
            (string)json_encode($dataDecoded['attributes'])
        );
    }

    protected function repositoryClassName(): string
    {
        return DoctrineEvent::class;
    }

    public static function subscribedTo(): array
    {
        return [
        ];
    }

    public function __invoke(Event ...$events): void
    {
        $this->publish(...$events);
    }
}
