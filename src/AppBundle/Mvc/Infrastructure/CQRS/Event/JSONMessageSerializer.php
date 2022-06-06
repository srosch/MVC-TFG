<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Event;

use InvalidArgumentException;
use Throwable;

abstract class JSONMessageSerializer
{
    /** @var iterable<MessageMapper> */
    private $mappers;

    /** @param iterable<MessageMapper> $mappers*/
    public function __construct(iterable $mappers)
    {
        $this->mappers = $mappers;
    }

    abstract protected function matchType(): string;

    /** @throws InvalidArgumentException */
    protected function validateDataValueType(array $data): void
    {
        if ($data['type'] !== $this->matchType()) {
            throw new InvalidArgumentException(sprintf(
                'Type "%s" received is invalid, it was expected the "%s" type from Message',
                $data['type'],
                $this->matchType()
            ));
        }
    }

    /** @throws InvalidArgumentException */
    protected function validateDataKeys(array $data): void
    {
        if (
            !array_key_exists($key = 'id', $data) || !array_key_exists($key = 'type', $data) ||
            !array_key_exists($key = 'occurredOn', $data) || !array_key_exists($key = 'attributes', $data) ||
            !array_key_exists($key = 'meta', $data) || !array_key_exists($key = 'message', $data['meta'])
        ) {
            throw new InvalidArgumentException(sprintf('Missing "%s" required key from Message', $key));
        }
    }

    /** @throws Throwable */
    protected function jsonEncode(array $data): string
    {
        return (string)json_encode($data);
    }

    /** @throws Throwable */
    protected function jsonDecode(string $payload): array
    {
        return json_decode($payload, true);
    }

    /** @throws Throwable */
    public function serialize(Message $message): string
    {
        $mapper = MessageMapper::findMapperByMessage($message, ...$this->mappers);

        $data = $mapper->toArray($message);

        $this->validateDataKeys($data);
        $this->validateDataValueType($data);

        return $this->jsonEncode($data);
    }

    /** @throws Throwable */
    public function deserialize(string $payload): Message
    {
        $data = $this->jsonDecode($payload);

        $this->validateDataKeys($data);
        $this->validateDataValueType($data);

        $mapper = MessageMapper::findMapperByName((string)$data['meta']['message'], ...$this->mappers);

        return $mapper->toMessage($data['attributes']);
    }
}
