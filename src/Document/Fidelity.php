<?php

namespace App\Document;

use App\Repository\FidelityRepository;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[MongoDB\Document(repositoryClass: FidelityRepository::class)]
class Fidelity
{
    #[MongoDB\Id]
    protected string $id;

    #[MongoDB\Field(type: 'string')]
    protected string $name;

    #[MongoDB\Field(type: 'int')]
    protected int $points;

    #[MongoDB\Field(type: 'string')]
    protected string $category;

    #[MongoDB\Field(type: 'string')]
    protected string $description;

    #[MongoDB\Field(type: 'string')]
    protected string $image;

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function setPoints(int $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
