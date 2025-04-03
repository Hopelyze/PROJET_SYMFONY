<?php

namespace App\Entity;
use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\Flowers;

#[ORM\Table(name: 'l3_cart')]
#[ORM\UnisqueConstraint(columns: ['id_user', 'id_flower', 'quantity'])]
#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Flowers::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Flowers $flower = null;

    #[ORM\Column]
    private ?int $quantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getFlower(): ?Flowers
    {
        return $this->flower;
    }

    public function setFlower(?Flowers $flower): static
    {
        $this->flower = $flower;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    
}