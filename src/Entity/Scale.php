<?php

namespace App\Entity;

use App\Repository\ScaleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScaleRepository::class)
 */
class Scale
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="scales")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=CarDetails::class, inversedBy="scales")
     * @ORM\JoinColumn(nullable=false)
     */
    private $carDetails;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCarDetails(): ?CarDetails
    {
        return $this->carDetails;
    }

    public function setCarDetails(?CarDetails $carDetails): self
    {
        $this->carDetails = $carDetails;

        return $this;
    }
}
