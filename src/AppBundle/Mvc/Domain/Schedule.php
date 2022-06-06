<?php declare(strict_types=1);
namespace Mvc\Domain;


use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Mvc\Infrastructure\CQRS\Aggregates\AggregateRoot;


/**
 * @MongoDB\Document(collection="Schedule")
 */
class Schedule extends AggregateRoot
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
     * @MongoDB\ReferenceOne(targetDocument="Mvc\Domain\MedicalCenter", simple=true)
     * @var MedicalCenter $center
     */
    private $center;
    /**
     * @MongoDB\ReferenceOne(targetDocument="Mvc\Domain\User", simple=true)
     * @var User $healthPersonnel
     */
    private $healthPersonnel;
    /**
     * @MongoDB\Field(type="date")
     */
    private $date;
    /**
     * @MongoDB\EmbedMany(targetDocument="Mvc\Domain\Notes")
     * @var Notes[] $notes
     */
    private $notes;

    public function __construct(
        string $id,
        User $patient,
        User $healthPersonnel,
        MedicalCenter $center,
        DateTimeImmutable $date,
        array $notes
    ) {
        $this->id = $id;
        $this->patient = $patient;
        $this->healthPersonnel = $healthPersonnel;
        $this->center = $center;
        $this->date = $date;
        $this->notes = $notes;
    }

    public static function create(
        string $id,
        User $patient,
        User $healthPersonnel,
        MedicalCenter $center,
        DateTimeImmutable $date,
        array $notes
    ): self {
        return new self(
            $id,
            $patient,
            $healthPersonnel,
            $center,
            $date,
            $notes
        );
    }

    public function update(
        User $patient,
        User $healthPersonnel,
        MedicalCenter $center,
        DateTimeImmutable $date,
        array $notes
    ): void {
        $this->patient = $patient;
        $this->healthPersonnel = $healthPersonnel;
        $this->center = $center;
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
    public function getHealthPersonnel(): User
    {
        return $this->healthPersonnel;
    }
    public function getCenter(): MedicalCenter
    {
        return $this->center;
    }

    /** @return Notes[]  */
    public function getNotes(): array
    {
        return $this->notes->getValues();
    }

    public function setDate(DateTimeImmutable $date): void
    {
        $this->date = $date;
    }


    public function addNote(Notes $note): void
    {
        $this->notes = array_merge($this->getNotes(), [$note]);
    }
}
