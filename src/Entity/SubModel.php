<?php

namespace App\Entity;

use App\Repository\SubModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubModelRepository::class)
 */
class SubModel
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
    private $bodyPlatform;

    /**
     * @ORM\ManyToOne(targetEntity=Model::class, inversedBy="subModels")
     */
    private $model;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bodyType;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="subModel", cascade={"persist","remove"}, orphanRemoval=true)
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBodyPlatform(): ?string
    {
        return $this->bodyPlatform;
    }

    public function setBodyPlatform(string $bodyPlatform): self
    {
        $this->bodyPlatform = $bodyPlatform;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): self
    {
        $this->model = $model;

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
            $image->setSubModel($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getSubModel() === $this) {
                $image->setSubModel(null);
            }
        }

        return $this;
    }

}
