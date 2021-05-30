<?php

namespace App\Entity;

use App\Repository\CarDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarDetailsRepository::class)
 */
class CarDetails
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(
     *     targetEntity=Engine::class,
     *      mappedBy="details",
     *     cascade={"persist", "remove"}
     *     )
     */
    private $engine;

    /**
     * @ORM\Column(type="integer")
     */
    private $speed;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="float")
     */
    private $fuelConsumption;

    /**
     * @ORM\OneToOne(
     *     targetEntity=SubModel::class,
     *     mappedBy="details",
     *     cascade={"persist", "remove"}
     *     )
     * @ORM\JoinColumn(
     *     nullable=false
     * )
     */
    private $subModel;

    /**
     * @ORM\OneToOne(
     *     targetEntity=Transmission::class,
     *     mappedBy="details",
     *     cascade={"persist", "remove"}
     *     )
     */
    private $transmission;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $drive;

    /**
     * @ORM\Column(type="float")
     */
    private $power;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $eco;

    /**
     * @ORM\Column(type="float")
     */
    private $fuelConsumptionMixed;

    /**
     * @ORM\Column(type="float")
     */
    private $fuelConsumptionExtra;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEngine(): ?Engine
    {
        return $this->engine;
    }

    public function setEngine(?Engine $engine): self
    {
        // unset the owning side of the relation if necessary
        if ($engine === null && $this->engine !== null) {
            $this->engine->setDetails(null);
        }

        // set the owning side of the relation if necessary
        if ($engine !== null && $engine->getDetails() !== $this) {
            $engine->setDetails($this);
        }

        $this->engine = $engine;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getFuelConsumption(): ?float
    {
        return $this->fuelConsumption;
    }

    public function setFuelConsumption(float $fuelConsumption): self
    {
        $this->fuelConsumption = $fuelConsumption;

        return $this;
    }

    public function getSubModel(): ?SubModel
    {
        return $this->subModel;
    }

    public function setSubModel(?SubModel $subModel): self
    {
        // unset the owning side of the relation if necessary
        if ($subModel === null && $this->subModel !== null) {
            $this->subModel->setDetails(null);
        }

        // set the owning side of the relation if necessary
        if ($subModel !== null && $subModel->getDetails() !== $this) {
            $subModel->setDetails($this);
        }

        $this->subModel = $subModel;

        return $this;
    }

    public function getTransmission(): ?Transmission
    {
        return $this->transmission;
    }

    public function setTransmission(?Transmission $transmission): self
    {
        // unset the owning side of the relation if necessary
        if ($transmission === null && $this->transmission !== null) {
            $this->transmission->setDetails(null);
        }

        // set the owning side of the relation if necessary
        if ($transmission !== null && $transmission->getDetails() !== $this) {
            $transmission->setDetails($this);
        }

        $this->transmission = $transmission;

        return $this;
    }

    public function getDrive(): ?string
    {
        return $this->drive;
    }

    public function setDrive(string $drive): self
    {
        $this->drive = $drive;

        return $this;
    }

    public function getPower(): ?float
    {
        return $this->power;
    }

    public function setPower(float $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getEco(): ?string
    {
        return $this->eco;
    }

    public function setEco(string $eco): self
    {
        $this->eco = $eco;

        return $this;
    }

    public function getFuelConsumptionMixed(): ?float
    {
        return $this->fuelConsumptionMixed;
    }

    public function setFuelConsumptionMixed(float $fuelConsumptionMixed): self
    {
        $this->fuelConsumptionMixed = $fuelConsumptionMixed;

        return $this;
    }

    public function getFuelConsumptionExtra(): ?float
    {
        return $this->fuelConsumptionExtra;
    }

    public function setFuelConsumptionExtra(float $fuelConsumptionExtra): self
    {
        $this->fuelConsumptionExtra = $fuelConsumptionExtra;

        return $this;
    }

}
