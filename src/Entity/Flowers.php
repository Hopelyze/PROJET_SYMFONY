<?php

namespace App\Entity;

use App\Repository\FlowersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'l3_flowers')]
#[ORM\Entity(repositoryClass: FlowersRepository::class)]
class Flowers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $wording = null;

    #[ORM\Column(type: 'float', precision: 10, scale: 2)]
    private ?float $price = null;

    #[ORM\Column]
    private ?int $quantityStock = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWording(): ?string
    {
        return $this->wording;
    }

    public function setWording(string $wording): static
    {
        $this->wording = $wording;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantityStock(): ?int
    {
        return $this->quantityStock;
    }

    public function setQuantityStock(?int $quantityStock): static
    {
        $this->quantityStock = $quantityStock;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;
        return $this;
    }
}