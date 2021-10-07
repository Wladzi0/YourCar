<?php

namespace App\Entity;

use App\Repository\FaultRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

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
    /**
     * @ORM\OneToMany(
     *     targetEntity=Image::class,
     *     mappedBy="fault",
     *     cascade={"persist","remove"},
     *     orphanRemoval=true
     *     )
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="faults")
     * @ORM\JoinColumn(nullable=false, name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="fault",cascade={"persist", "remove"})
     */
    private $comments;

    /**
     * @ORM\Column(type="boolean" )
     */
    private $published = false;

    public function __construct()
    {
        $this->engine = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->subModel = new ArrayCollection();
        $this->comments = new ArrayCollection();
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
            $image->setFault($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getFault() === $this) {
                $image->setFault(null);
            }
        }

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $comment->setFault($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getFault() === $this) {
                $comment->setFault(null);
            }
        }

        return $this;
    }

    public function getPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }
    
}
