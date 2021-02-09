<?php

namespace App\Entity;

use App\Repository\StatsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatsRepository::class)
 */
class Stats
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $counter;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $codeCount;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $letterCount;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $noteCount;

    /**
     * Stats constructor.
     * @param int|null $counter
     * @param int|null $codeCount
     * @param int|null $letterCount
     * @param int|null $noteCount
     */
    public function __construct(?int $counter, ?int $codeCount, ?int $letterCount, ?int $noteCount)
    {
        $this->counter = $counter;
        $this->codeCount = $codeCount;
        $this->letterCount = $letterCount;
        $this->noteCount = $noteCount;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getCounter(): ?int
    {
        return $this->counter;
    }

    /**
     * @param int|null $counter
     */
    public function setCounter(?int $counter): void
    {
        $this->counter = $counter;
    }

    /**
     * @return int|null
     */
    public function getCodeCount(): ?int
    {
        return $this->codeCount;
    }

    /**
     * @param int|null $codeCount
     */
    public function setCodeCount(?int $codeCount): void
    {
        $this->codeCount = $codeCount;
    }

    /**
     * @return int|null
     */
    public function getLetterCount(): ?int
    {
        return $this->letterCount;
    }

    /**
     * @param int|null $letterCount
     */
    public function setLetterCount(?int $letterCount): void
    {
        $this->letterCount = $letterCount;
    }

    /**
     * @return int|null
     */
    public function getNoteCount(): ?int
    {
        return $this->noteCount;
    }

    /**
     * @param int|null $noteCount
     */
    public function setNoteCount(?int $noteCount): void
    {
        $this->noteCount = $noteCount;
    }

}
