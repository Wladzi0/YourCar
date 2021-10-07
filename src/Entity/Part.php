<?php

namespace App\Entity;

use App\Repository\PartRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PartRepository::class)
 */
class Part
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
    private $catalogNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=SubModel::class, inversedBy="parts")
     */
    private $car;

    /**
     * @ORM\ManyToOne(targetEntity=Engine::class, inversedBy="parts")
     */
    private $engine;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatalogNumber(): ?string
    {
        return $this->catalogNumber;
    }

    public function setCatalogNumber(string $catalogNumber): self
    {
        $this->catalogNumber = $catalogNumber;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCar(): ?SubModel
    {
        return $this->car;
    }

    public function setCar(?SubModel $car): self
    {
        $this->car = $car;

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
}
