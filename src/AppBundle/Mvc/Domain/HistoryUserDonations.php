<?php declare(strict_types=1);
namespace Mvc\Domain;


use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Mvc\Infrastructure\CQRS\Aggregates\AggregateRoot;


/**
 * @MongoDB\Document(collection="HistoryUserDonations")
 */
class HistoryUserDonations extends AggregateRoot
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
     * @MongoDB\Field(type="donation_type_type")
     * @var DonationType $type
     */
    private $type;
    /**
     * @MongoDB\Field(type="date")
     */
    private $date;
    /**
     * @MongoDB\Field(type="string")
     */
    private $notes;

    public function __construct(
        string $id,
        User $patient,
        DonationType $type,
        DateTimeImmutable $date,
        string $notes
    ) {
        $this->id = $id;
        $this->patient = $patient;
        $this->type = $type;
        $this->date = $date;
        $this->notes = $notes;
    }

    public static function create(
        string $id,
        User $patient,
        DonationType $type,
        DateTimeImmutable $date,
        string $notes
    ): self {
        return new self(
            $id,
            $patient,
            $type,
            $date,
            $notes
        );
    }

    public function update(
        User $patient,
        DonationType $type,
        DateTimeImmutable $date,
        string $notes
    ): void {
        $this->patient = $patient;
        $this->type = $type;
        $this->date = $date;
        $this->notes = $notes;
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
    public function getType(): DonationType
    {
        return $this->type;
    }
    public function getNotes(): string
    {
        return $this->notes;
    }
}
