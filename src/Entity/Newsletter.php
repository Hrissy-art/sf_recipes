<?php

namespace App\Entity;

use App\Repository\NewsletterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: NewsletterRepository::class)]
#[UniqueEntity('email', message: "Cet email existe déjà")]
class Newsletter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column]
    private ?bool $Subscribed = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $subscribedDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function isSubscribed(): ?bool
    {
        return $this->Subscribed;
    }

    public function setSubscribed(bool $Subscribed): static
    {
        $this->Subscribed = $Subscribed;

        return $this;
    }

    public function getSubscribedDate(): ?\DateTimeInterface
    {
        return $this->subscribedDate;
    }

    public function setSubscribedDate(\DateTimeInterface $subscribedDate): static
    {
        $this->subscribedDate = $subscribedDate;

        return $this;
    }
}
