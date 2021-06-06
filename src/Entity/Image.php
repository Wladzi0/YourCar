<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @Vich\Uploadable()
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column (type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="car_details", fileNameProperty="image")
     * @var File
     */
    private $imageFile;


    /**
     * @ORM\ManyToOne(
     *     targetEntity=Engine::class,
     *     inversedBy="images",
     *     cascade={"persist","remove"}
     *     )
     */
    private $engine;

    /**
     * @ORM\ManyToOne(
     *     targetEntity=Rim::class,
     *     inversedBy="images",
     *     cascade={"persist","remove"}
     *     )
     */
    private $rim;
    /**
     * @ORM\ManyToOne(
     *     targetEntity=Fault::class,
     *     inversedBy="images",
     *     cascade={"persist","remove"}
     *     )
     */
    private $fault;

    /**
     * @ORM\ManyToOne(
     *     targetEntity=SubModel::class,
     *     inversedBy="images",
     *     cascade={"persist","remove"}
     *     )
     */
    private $subModel;

    public function getId(): ?int
    {
        return $this->id;
    }
    

    public function getImage(): ?string
    {
        return $this->image;
    }


    public function setImage(string $image = null): self
    {
        $this->image = $image;
        return $this;
    }


    public function getImageFile()
    {
        return $this->imageFile;
    }


    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
    }

    public function getEngine(): ?Engine
    {
        return $this->engine;
    }

    public function setEngine(?Engine $engine): self
    {
        $this->engine = $engine;

        return $this;
    }
    public function getFault(): ?Fault
    {
        return $this->fault;
    }

    public function setFault(?Fault $fault): self
    {
        $this->fault = $fault;

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

    public function getSubModel(): ?SubModel
    {
        return $this->subModel;
    }

    public function setSubModel(?SubModel $subModel): self
    {
        $this->subModel = $subModel;

        return $this;
    }
    public function __toString()
    {
      return $this->image;
    }
}
