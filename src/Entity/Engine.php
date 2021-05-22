<?php

namespace App\Entity;

use App\Repository\EngineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EngineRepository::class)
 */
class Engine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Model::class, inversedBy="engines")
     */
    private $models;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="engine", cascade={"persist","remove"}, orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $capacity;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $power;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $fuel;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $abbreviation;

    /**
     * @ORM\ManyToMany(targetEntity=Fault::class, mappedBy="engine")
     */
    private $faults;

    public function __construct()
    {
        $this->models = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->faults = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setEngine($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getEngine() === $this) {
                $image->setEngine(null);
            }
        }

        return $this;
    }

    public function getCapacity(): ?string
    {
        return $this->capacity;
    }

    public function setCapacity(string $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getPower(): ?string
    {
        return $this->power;
    }

    public function setPower(string $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): self
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(string $abbreviation): self
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    /**
     * @return Collection|Fault[]
     */
    public function getFaults(): Collection
    {
        return $this->faults;
    }

    public function addFault(Fault $fault): self
    {
        if (!$this->faults->contains($fault)) {
            $this->faults[] = $fault;
            $fault->addEngine($this);
        }

        return $this;
    }

    public function removeFault(Fault $fault): self
    {
        if ($this->faults->removeElement($fault)) {
            $fault->removeEngine($this);
        }

        return $this;
    }

    public function __toString()
    {
      return $this->capacity.' '.$this->abbreviation;
    }
}
