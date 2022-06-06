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
 * @MongoDB\Document(collection="UserDiseaseTreatment")
 */
class UserDiseaseTreatment extends AggregateRoot
{
    /**
     * @MongoDB\Id(strategy="auto")
     * @var string $id
     */
    private $id;
    /**
     * @MongoDB\Field(type="string")
     * @var string $historyUserDisease
     */
    private $historyUserDisease;
    /**
     * @MongoDB\Field(type="date")
     */
    private $initDate;
    /**
     * @MongoDB\Field(type="date")
     */
    private $endDate;
    /**
     * @MongoDB\Field(type="string")
     */
    private $notes;

    public function __construct(
        string $id,
        string $historyUserDisease,
        DateTimeImmutable $initDate,
        ?DateTimeImmutable $endDate,
        string $notes
    ) {
        $this->id = $id;
        $this->historyUserDisease = $historyUserDisease;
        $this->initDate = $initDate;
        $this->endDate = $endDate;
        $this->notes = $notes;
    }

    public static function create(
        string $id,
        string $historyUserDisease,
        DateTimeImmutable $initDate,
        ?DateTimeImmutable $endDate,
        string $notes
    ): self {
        return new self(
            $id,
            $historyUserDisease,
            $initDate,
            $endDate,
            $notes
        );
    }

    public function update(
        string $historyUserDisease,
        DateTimeImmutable $initDate,
        ?DateTimeImmutable $endDate,
        string $notes
    ): void {
        $this->historyUserDisease = $historyUserDisease;
        $this->initDate = $initDate;
        $this->endDate = $endDate;
        $this->notes = $notes;
    }

    public function getId(): string
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getInitDate()
    {
        return $this->initDate;
    }
    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
    public function getHistoryUserDisease(): string
    {
        return $this->historyUserDisease;
    }
    public function getNotes(): string
    {
        return $this->notes;
    }
}
