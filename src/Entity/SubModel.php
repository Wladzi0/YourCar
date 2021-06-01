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
     * @ORM\OneToMany(
     *     targetEntity=Image::class,
     *     mappedBy="subModel",
     *     cascade={"persist","remove"},
     *     orphanRemoval=true
     *     )
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity=Rim::class, mappedBy="subModels")
     */
    private $rims;

    /**
     * @ORM\ManyToMany(targetEntity=Engine::class, mappedBy="subModels")
     */
    private $engines;

    /**
     * @ORM\ManyToMany(
     *     targetEntity=Fault::class,
     *     mappedBy="subModel",
     *     cascade={"persist","remove"}
     *     )
     */
    private $faults;

    /**
     * @ORM\Column(type="integer")
     */
    private $yearStart;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $yearFinish;

    /**
     * @ORM\Column(type="integer")
     */
    private $tank;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $length;

    /**
     * @ORM\Column(type="float")
     */
    private $width;

    /**
     * @ORM\OneToMany(targetEntity=CarDetails::class, mappedBy="subModel", cascade={"persist"})
     */
    private $details;

    public function __construct()
    {

        $this->faults = new ArrayCollection();
        $this->engines = new ArrayCollection();
        $this->rims = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->details = new ArrayCollection();
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
    public function __toString()
    {
        return $this->model.'('.$this->bodyPlatform.')';
    }

    /**
     * @return Collection|Rim[]
     */
    public function getRims(): Collection
    {
        return $this->rims;
    }

    public function addRim(Rim $rim): self
    {
        if (!$this->rims->contains($rim)) {
            $this->rims[] = $rim;
            $rim->addSubModel($this);
        }

        return $this;
    }

    public function removeRim(Rim $rim): self
    {
        if ($this->rims->removeElement($rim)) {
            $rim->removeSubModel($this);
        }

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
            $engine->addSubModel($this);
        }

        return $this;
    }

    public function removeEngine(Engine $engine): self
    {
        if ($this->engines->removeElement($engine)) {
            $engine->removeSubModel($this);
        }

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
            $fault->addSubModel($this);
        }

        return $this;
    }

    public function removeFault(Fault $fault): self
    {
        if ($this->faults->removeElement($fault)) {
            $fault->removeSubModel($this);
        }

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

    public function getTank(): ?int
    {
        return $this->tank;
    }

    public function setTank(int $tank): self
    {
        $this->tank = $tank;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(float $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(float $width): self
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return Collection|CarDetails[]
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(CarDetails $detail): self
    {
        if (!$this->details->contains($detail)) {
            $this->details[] = $detail;
            $detail->setSubModel($this);
        }

        return $this;
    }

    public function removeDetail(CarDetails $detail): self
    {
        if ($this->details->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getSubModel() === $this) {
                $detail->setSubModel(null);
            }
        }

        return $this;
    }


}
