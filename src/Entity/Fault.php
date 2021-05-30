<?php

namespace App\Entity;

use App\Repository\FaultRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FaultRepository::class)
 */
class Fault
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
     * @ORM\ManyToMany(targetEntity=Engine::class, inversedBy="faults")
     */
    private $engine;

    /**
     * @ORM\ManyToMany(targetEntity=SubModel::class, inversedBy="faults")
     */
    private $subModel;

    /**
     * @ORM\Column(type="string", length=9000)
     */
    private $description;

    public function __construct()
    {
        $this->engine = new ArrayCollection();
        $this->subModel = new ArrayCollection();
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
     * @return Collection|Engine[]
     */
    public function getEngine(): Collection
    {
        return $this->engine;
    }

    public function addEngine(Engine $engine): self
    {
        if (!$this->engine->contains($engine)) {
            $this->engine[] = $engine;
        }

        return $this;
    }

    public function removeEngine(Engine $engine): self
    {
        $this->engine->removeElement($engine);

        return $this;
    }

    /**
     * @return Collection|SubModel[]
     */
    public function getSubModel(): Collection
    {
        return $this->subModel;
    }

    public function addSubModel(SubModel $subModel): self
    {
        if (!$this->subModel->contains($subModel)) {
            $this->subModel[] = $subModel;
        }

        return $this;
    }

    public function removeSubModel(SubModel $subModel): self
    {
        $this->subModel->removeElement($subModel);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }
}
