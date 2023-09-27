<?php

namespace App\Entity;

use App\Repository\UserChallengeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserChallengeRepository::class)]
class UserChallenge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $statut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fin_obligatoire = null;

    #[ORM\ManyToOne(inversedBy: 'Challenges')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'userChallenge', targetEntity: Challenge::class)]
    private Collection $UserChallenge;

    public function __construct()
    {
        $this->UserChallenge = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getDateFinObligatoire(): ?\DateTimeInterface
    {
        return $this->date_fin_obligatoire;
    }

    public function setDateFinObligatoire(\DateTimeInterface $date_fin_obligatoire): static
    {
        $this->date_fin_obligatoire = $date_fin_obligatoire;

        return $this;
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

    /**
     * @return Collection<int, Challenge>
     */
    public function getUserChallenge(): Collection
    {
        return $this->UserChallenge;
    }

    public function addUserChallenge(Challenge $userChallenge): static
    {
        if (!$this->UserChallenge->contains($userChallenge)) {
            $this->UserChallenge->add($userChallenge);
            $userChallenge->setUserChallenge($this);
        }

        return $this;
    }

    public function removeUserChallenge(Challenge $userChallenge): static
    {
        if ($this->UserChallenge->removeElement($userChallenge)) {
            // set the owning side to null (unless already changed)
            if ($userChallenge->getUserChallenge() === $this) {
                $userChallenge->setUserChallenge(null);
            }
        }

        return $this;
    }
}
