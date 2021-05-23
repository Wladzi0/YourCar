<?php

namespace App\Entity;

use App\Repository\RimRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RimRepository::class)
 */
class Rim
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
    private $size;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    private $departure;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="rim", cascade={"persist","remove"}, orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $pcd;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $stud;

    /**
     * @ORM\ManyToMany(targetEntity=Model::class, inversedBy="rims")
     */
    private $models;


    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->models = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(string $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getDeparture(): ?string
    {
        return $this->departure;
    }

    public function setDeparture(?string $departure): self
    {
        $this->departure = $departure;

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
            $image->setRim($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getRim() === $this) {
                $image->setRim(null);
            }
        }

        return $this;
    }

    public function getPcd(): ?string
    {
        return $this->pcd;
    }

    public function setPcd(string $pcd): self
    {
        $this->pcd = $pcd;

        return $this;
    }

    public function getStud(): ?string
    {
        return $this->stud;
    }

    public function setStud(string $stud): self
    {
        $this->stud = $stud;

        return $this;
    }

    public function __toString()
    {
        return $this->size;
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

}
