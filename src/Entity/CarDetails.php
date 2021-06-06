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
     * @ORM\Column(type="string", length=255)
     */
    private $drive;

    /**
     * @ORM\Column(type="float")
     */
    private $power;

    /**
     * @ORM\Column(type="integer")
     */
    private $torque;

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

    /**
     * @ORM\ManyToOne(targetEntity=SubModel::class, inversedBy="details",cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $subModel;

    /**
     * @ORM\Column(type="integer")
     */
    private $yearStart;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $yearFinish;

    /**
     * @ORM\ManyToOne(targetEntity=Engine::class, inversedBy="carDetails", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $engine;

    /**
     * @ORM\ManyToOne(targetEntity=Transmission::class, inversedBy="car_details")
     * @ORM\JoinColumn(nullable=false)
     */
    private $transmission;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSubModel(): ?SubModel
    {
        return $this->subModel;
    }

    public function setSubModel(?SubModel $subModel): self
    {
        $this->subModel = $subModel;

        return $this;
    }

    public function getYearStart(): ?int
    {
        return $this->yearStart;
    }

    public function setYearStart(int $yearStart): self
    {
        $this->yearStart = $yearStart;

        return $this;
    }

    public function getYearFinish(): ?int
    {
        return $this->yearFinish;
    }

    public function setYearFinish(?int $yearFinish): self
    {
        $this->yearFinish = $yearFinish;

        return $this;
    }

    public function getEngine(): ?Engine
    {
        return $this->engine;
    }

    public function setEngine(?Engine $engine): self
    {
        $this->engine = $engine;

        return $this;
    }

    public function getTransmission(): ?Transmission
    {
        return $this->transmission;
    }

    public function setTransmission(?Transmission $transmission): self
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getTorque(): ?int
    {
        return $this->torque;
    }

    public function setTorque(int $torque): self
    {
        $this->torque = $torque;

        return $this;
    }

}