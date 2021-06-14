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
     * @ORM\ManyToMany(targetEntity=SubModel::class, inversedBy="engines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subModels;

    /**
     * @ORM\OneToMany(
     *     targetEntity=Image::class,
     *     mappedBy="engine",
     *     cascade={"persist","remove"},
     *     orphanRemoval=true
     *     )
     */
    private $images;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $capacity;

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


    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $weight;

    /**
     * @ORM\OneToMany(targetEntity=CarDetails::class, mappedBy="engine", cascade={"persist"})
     */
    private $carDetails;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $powerIncrease;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $oil;

    /**
     * @ORM\Column(type="integer")
     */
    private $cylinders;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="engine")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Rating::class, mappedBy="engine")
     */
    private $ratings;

    public function __construct()
    {
        $this->subModels = new ArrayCollection();
        $this->models = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->faults = new ArrayCollection();
        $this->carDetails = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->ratings = new ArrayCollection();
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
     * @return Collection|SubModel[]
     */
    public function getSubModels(): Collection
    {
        return $this->subModels;
    }

    public function addSubModel(SubModel $subModel): self
    {
        if (!$this->subModels->contains($subModel)) {
            $this->subModels[] = $subModel;
        }

        return $this;
    }

    public function removeSubModel(SubModel $subModel): self
    {
        $this->subModels->removeElement($subModel);

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

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return Collection|CarDetails[]
     */
    public function getCarDetails(): Collection
    {
        return $this->carDetails;
    }

    public function addCarDetail(CarDetails $carDetail): self
    {
        if (!$this->carDetails->contains($carDetail)) {
            $this->carDetails[] = $carDetail;
            $carDetail->setEngine($this);
        }

        return $this;
    }

    public function removeCarDetail(CarDetails $carDetail): self
    {
        if ($this->carDetails->removeElement($carDetail)) {
            // set the owning side to null (unless already changed)
            if ($carDetail->getEngine() === $this) {
                $carDetail->setEngine(null);
            }
        }

        return $this;
    }

    public function getPowerIncrease(): ?string
    {
        return $this->powerIncrease;
    }

    public function setPowerIncrease(string $powerIncrease): self
    {
        $this->powerIncrease = $powerIncrease;

        return $this;
    }

    public function getOil(): ?float
    {
        return $this->oil;
    }

    public function setOil(?float $oil): self
    {
        $this->oil = $oil;

        return $this;
    }

    public function getCylinders(): ?int
    {
        return $this->cylinders;
    }

    public function setCylinders(int $cylinders): self
    {
        $this->cylinders = $cylinders;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setEngine($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getEngine() === $this) {
                $comment->setEngine(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rating[]
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): self
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings[] = $rating;
            $rating->setEngine($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getEngine() === $this) {
                $rating->setEngine(null);
            }
        }

        return $this;
    }

}
