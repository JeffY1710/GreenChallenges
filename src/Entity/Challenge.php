<?php

namespace App\Entity;

use App\Repository\ChallengeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChallengeRepository::class)]
class Challenge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sub_category = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $deadline = null;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\ManyToOne(inversedBy: 'UserChallenge')]
    #[ORM\JoinColumn(nullable: true)]
    private ?UserChallenge $userChallenge = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getSubCategory(): ?string
    {
        return $this->sub_category;
    }

    public function setSubCategory(?string $sub_category): static
    {
        $this->sub_category = $sub_category;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDeadline(): ?int
    {
        return $this->deadline;
    }

    public function setDeadline(int $deadline): static
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function getUserChallenge(): ?UserChallenge
    {
        return $this->userChallenge;
    }

    public function setUserChallenge(?UserChallenge $userChallenge): static
    {
        $this->userChallenge = $userChallenge;

        return $this;
    }
}
