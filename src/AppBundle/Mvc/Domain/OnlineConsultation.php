<?php declare(strict_types=1);
namespace Mvc\Domain;


use Mvc\Domain\ResponseOnlineConsultation;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Mvc\Infrastructure\CQRS\Aggregates\AggregateRoot;


/**
 * @MongoDB\Document(collection="OnlineConsultation")
 */
class OnlineConsultation extends AggregateRoot
{
    /**
     * @MongoDB\Id(strategy="auto")
     * @var string $id
     */
    private $id;
    /**
     * @MongoDB\ReferenceOne(targetDocument="Mvc\Domain\User", simple=true)
     * @var User $patient
     */
    private $patient;
    /**
     * @MongoDB\Field(type="date")
     */
    private $date;
    /**
     * @MongoDB\Field(type="string")
     */
    private $text;
    /**
     * @MongoDB\EmbedOne(targetDocument="Mvc\Domain\ResponseOnlineConsultation")
     * @var null|ResponseOnlineConsultation $response
     */
    private $response;

    public function __construct(
        string $id,
        User $patient,
        DateTimeImmutable $date,
        string $text,
        ?ResponseOnlineConsultation $response
    ) {
        $this->id = $id;
        $this->patient = $patient;
        $this->date = $date;
        $this->text = $text;
        $this->response = $response;
    }

    public static function create(
        string $id,
        User $patient,
        DateTimeImmutable $date,
        string $text,
        ?ResponseOnlineConsultation $response
    ): self {
        return new self(
            $id,
            $patient,
            $date,
            $text,
            $response
        );
    }

    public function update(
        User $patient,
        DateTimeImmutable $date,
        string $text,
        ?ResponseOnlineConsultation $response
    ): void {
        $this->patient = $patient;
        $this->date = $date;
        $this->text = $text;
        $this->response = $response;
    }

    public function getId(): string
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }
    public function getPatient(): User
    {
        return $this->patient;
    }
    public function getText(): string
    {
        return $this->text;
    }
    public function getResponse(): ?ResponseOnlineConsultation
    {
        return $this->response;
    }

    public function setResponse(ResponseOnlineConsultation $response): void
    {
        $this->response = $response;
    }
}
