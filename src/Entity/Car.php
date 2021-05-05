<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $make;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $engine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $transmition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $enginePower;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeSize;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fuelEconomy;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $forWhat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fuelType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bodyType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bootCapacity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rareness;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $engineLife;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $failureRate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tuning;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMake(): ?string
    {
        return $this->make;
    }

    public function setMake(string $make): self
    {
        $this->make = $make;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getEngine(): ?string
    {
        return $this->engine;
    }

    public function setEngine(string $engine): self
    {
        $this->engine = $engine;

        return $this;
    }

    public function getTransmition(): ?string
    {
        return $this->transmition;
    }

    public function setTransmition(string $transmition): self
    {
        $this->transmition = $transmition;

        return $this;
    }

    public function getEnginePower(): ?string
    {
        return $this->enginePower;
    }

    public function setEnginePower(string $enginePower): self
    {
        $this->enginePower = $enginePower;

        return $this;
    }

    public function getTypeSize(): ?string
    {
        return $this->typeSize;
    }

    public function setTypeSize(string $typeSize): self
    {
        $this->typeSize = $typeSize;

        return $this;
    }

    public function getFuelEconomy(): ?string
    {
        return $this->fuelEconomy;
    }

    public function setFuelEconomy(string $fuelEconomy): self
    {
        $this->fuelEconomy = $fuelEconomy;

        return $this;
    }

    public function getForWhat(): ?string
    {
        return $this->forWhat;
    }

    public function setForWhat(string $forWhat): self
    {
        $this->forWhat = $forWhat;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getFuelType(): ?string
    {
        return $this->fuelType;
    }

    public function setFuelType(string $fuelType): self
    {
        $this->fuelType = $fuelType;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getBodyType(): ?string
    {
        return $this->bodyType;
    }

    public function setBodyType(string $bodyType): self
    {
        $this->bodyType = $bodyType;

        return $this;
    }

    public function getBootCapacity(): ?string
    {
        return $this->bootCapacity;
    }

    public function setBootCapacity(string $bootCapacity): self
    {
        $this->bootCapacity = $bootCapacity;

        return $this;
    }

    public function getRareness(): ?string
    {
        return $this->rareness;
    }

    public function setRareness(string $rareness): self
    {
        $this->rareness = $rareness;

        return $this;
    }

    public function getEngineLife(): ?string
    {
        return $this->engineLife;
    }

    public function setEngineLife(string $engineLife): self
    {
        $this->engineLife = $engineLife;

        return $this;
    }

    public function getFailureRate(): ?string
    {
        return $this->failureRate;
    }

    public function setFailureRate(string $failureRate): self
    {
        $this->failureRate = $failureRate;

        return $this;
    }

    public function getTuning(): ?string
    {
        return $this->tuning;
    }

    public function setTuning(string $tuning): self
    {
        $this->tuning = $tuning;

        return $this;
    }
}
