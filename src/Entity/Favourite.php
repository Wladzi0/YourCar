<?php

namespace App\Entity;

use App\Repository\FavouriteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FavouriteRepository::class)
 */
class Favourite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CarDetails::class, inversedBy="favourites", cascade={"persist", "remove"})
     */
    private $carDetails;

    /**
     * @ORM\ManyToOne(targetEntity=Comment::class, inversedBy="favourites")
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="favourites")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarDetails(): ?CarDetails
    {
        return $this->carDetails;
    }

    public function setCarDetails(?CarDetails $carDetails): self
    {
        $this->carDetails = $carDetails;

        return $this;
    }

    public function getComment(): ?Comment
    {
        return $this->comment;
    }

    public function setComment(?Comment $comment): self
    {
        $this->comment = $comment;

        return $this;
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
}
