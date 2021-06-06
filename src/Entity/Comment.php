<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Fault::class, inversedBy="comments")
     */
    private $fault;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
     * @ORM\JoinColumn (nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="text", length=10000)
     */
    private $content;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @var DateTimeInterface|null
     */
    private $createdAt;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime('now'));
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
