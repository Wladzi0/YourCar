<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ModelRepository::class)
 * @Vich\Uploadable()
 */
class Model
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
     * @ORM\ManyToOne(targetEntity=Make::class, inversedBy="models", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $make;

    /**
     * @ORM\ManyToMany(targetEntity=Engine::class, mappedBy="models")
     */
    private $engines;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="model", cascade={"persist","remove"}, orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity=Rim::class, inversedBy="models", cascade={"persist"})
     */
    private $rim;



    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->engines = new ArrayCollection();
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

    public function getMake(): ?Make
    {
        return $this->make;
    }

    public function setMake(?Make $make): self
    {
        $this->make = $make;

        return $this;
    }

    /**
     * @return Collection|Engine[]
     */
    public function getEngines(): Collection
    {
        return $this->engines;
    }

    public function addEngine(Engine $engine): self
    {
        if (!$this->engines->contains($engine)) {
            $this->engines[] = $engine;
            $engine->addModel($this);
        }

        return $this;
    }

    public function removeEngine(Engine $engine): self
    {
        if ($this->engines->removeElement($engine)) {
            $engine->removeModel($this);
        }

        return $this;
    }


    public function __toString()
    {
        return $this->name;
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
            $image->setModel($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getModel() === $this) {
                $image->setModel(null);
            }
        }
        return $this;
    }

    public function getRim(): ?Rim
    {
        return $this->rim;
    }

    public function setRim(?Rim $rim): self
    {
        $this->rim = $rim;

        return $this;
    }


}
