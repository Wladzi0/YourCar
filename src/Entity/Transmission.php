<?php

namespace App\Entity;

use App\Repository\TransmissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransmissionRepository::class)
 */
class Transmission
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Model::class, inversedBy="transmissions")
     */
    private $models;

    /**
     * @ORM\OneToMany(targetEntity=CarDetails::class, mappedBy="transmission")
     */
    private $car_details;

    public function __construct()
    {
        $this->models = new ArrayCollection();
        $this->car_details = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Model[]
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(Model $model): self
    {
        if (!$this->models->contains($model)) {
            $this->models[] = $model;
        }

        return $this;
    }

    public function removeModel(Model $model): self
    {
        $this->models->removeElement($model);

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|CarDetails[]
     */
    public function getCarDetails(): Collection
    {
        return $this->car_details;
    }

    public function addCarDetail(CarDetails $carDetail): self
    {
        if (!$this->car_details->contains($carDetail)) {
            $this->car_details[] = $carDetail;
            $carDetail->setTransmission($this);
        }

        return $this;
    }

    public function removeCarDetail(CarDetails $carDetail): self
    {
        if ($this->car_details->removeElement($carDetail)) {
            // set the owning side to null (unless already changed)
            if ($carDetail->getTransmission() === $this) {
                $carDetail->setTransmission(null);
            }
        }

        return $this;
    }
    
}
