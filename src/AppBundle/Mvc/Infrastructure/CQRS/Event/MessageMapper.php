<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Event;

use Throwable;

abstract class MessageMapper
{
    /** @throws MessageMapperNotFoundException */
    public static function findMapperByMessage(
        Message $message,
        MessageMapper ...$mappers
    ): MessageMapper
    {
        foreach ($mappers as $mapper) {
            if ($mapper->belongsTo() === get_class($message)) {
                return $mapper;
            }
        }
        throw new MessageMapperNotFoundException();
    }

    /** @throws MessageMapperNotFoundException */
    public static function findMapperByName(
        string $messageName,
        MessageMapper ...$mappers
    ): MessageMapper
    {
        foreach ($mappers as $mapper) {
            if (sprintf('%s.%s', $mapper->serviceName(), $mapper->name()) === $messageName) {
                return $mapper;
            }
        }
        throw new MessageMapperNotFoundException();
    }

    /** @throws Throwable */
    public function toArray(Message $message): array
    {
        return array_merge($message->getMeta(), [
            'attributes' => $this->toAttributes($message),
            'meta' => [
                'message' => sprintf('%s.%s', $this->serviceName(), $this->name())
            ],
        ]);
    }

    /** @throws Throwable */
    abstract public function toMessage(array $payload): Message;

    protected function toAttributes(Message $message): array
    {
        return $message->getAttributes();
    }

    /** <Message>::class */
    abstract public function belongsTo(): string;

    /** "Unique" <Service> name */
    abstract public function serviceName(): string;

    /** "Unique" <Message> name */
    abstract public function name(): string;
}
