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
     * @ORM\ManyToMany(targetEntity=Model::class, inversedBy="faults")
     */
    private $model;

    public function __construct()
    {
        $this->engine = new ArrayCollection();
        $this->model = new ArrayCollection();
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
     * @return Collection|Model[]
     */
    public function getModel(): Collection
    {
        return $this->model;
    }

    public function addModel(Model $model): self
    {
        if (!$this->model->contains($model)) {
            $this->model[] = $model;
        }

        return $this;
    }

    public function removeModel(Model $model): self
    {
        $this->model->removeElement($model);

        return $this;
    }
}
