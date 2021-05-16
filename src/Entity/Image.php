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
     * @Vich\UploadableField(mapping="models_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\ManyToOne(targetEntity=Model::class, inversedBy="images",cascade={"persist","remove"})
     */
    private $model;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getImage(): ?string
    {
        return $this->image;
    }


    public function setImage(string $image = null): self // "string $image = null" Is very important to delete image during editing
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
}
