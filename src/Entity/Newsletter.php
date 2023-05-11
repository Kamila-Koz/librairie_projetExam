<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\NewsletterRepository;

#[ORM\Entity(repositoryClass: NewsletterRepository::class)]
class Newsletter
{
    use CreatedAtTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $status_newsletter = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $deleted_at = null;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getStatusNewsletter(): ?string
    {
        return $this->status_newsletter;
    }

    public function setStatusNewsletter(string $status_newsletter): self
    {
        $this->status_newsletter = $status_newsletter;

        return $this;
    }
}
