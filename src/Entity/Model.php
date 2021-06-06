<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
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
     * @ORM\ManyToOne(
     *     targetEntity=Make::class,
     *     inversedBy="models",
     *     cascade={"persist"}
     *     )
     * @ORM\JoinColumn(nullable=false)
     */
    private $make;

    /**
     * @ORM\ManyToMany(targetEntity=Engine::class, mappedBy="models")
     */
    private $engines;

    /**
     * @ORM\Column(type="integer")
     */
    private $yearStart;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $yearFinish;

    /**
     * @ORM\ManyToMany(
     *     targetEntity=Transmission::class,
     *     mappedBy="models",
     *     cascade={"persist","remove"}
     *     )
     */
    private $transmissions;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $bodyType = [];

    /**
     * @ORM\OneToMany(targetEntity=SubModel::class, mappedBy="model")
     */
    private $subModels;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $icon;

    /**
     * @Vich\UploadableField(
     *     mapping="commom_models",
     *     fileNameProperty="icon"
     *  )
     * @var File
     */
    private $iconFile;

    public function __construct()
    {
        $this->engines = new ArrayCollection();
        $this->transmissions = new ArrayCollection();
        $this->subModels = new ArrayCollection();
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

    /**
     * @return Collection|Transmission[]
     */
    public function getTransmissions(): Collection
    {
        return $this->transmissions;
    }

    public function addTransmission(Transmission $transmission): self
    {
        if (!$this->transmissions->contains($transmission)) {
            $this->transmissions[] = $transmission;
            $transmission->addModel($this);
        }

        return $this;
    }

    public function removeTransmission(Transmission $transmission): self
    {
        if ($this->transmissions->removeElement($transmission)) {
            $transmission->removeModel($this);
        }

        return $this;
    }

    public function getBodyType(): ?array
    {
        return $this->bodyType;
    }

    public function setBodyType(?array $bodyType): self
    {
        $this->bodyType = $bodyType;

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
            $subModel->setModel($this);
        }

        return $this;
    }

    public function removeSubModel(SubModel $subModel): self
    {
        if ($this->subModels->removeElement($subModel)) {
            // set the owning side to null (unless already changed)
            if ($subModel->getModel() === $this) {
                $subModel->setModel(null);
            }
        }

        return $this;
    }
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getIconFile(): ?File
    {
        return $this->iconFile;
    }

    public function setIconFile(?File $iconFile = null)
    {
        $this->iconFile = $iconFile;

    }


}
