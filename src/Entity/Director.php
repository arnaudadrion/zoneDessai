<?php

namespace App\Entity;

use App\Repository\DirectorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DirectorRepository::class)]
class Director
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'director', targetEntity: TeamChief::class)]
    private Collection $teamChiefs;

    #[ORM\OneToOne(mappedBy: 'director', cascade: ['persist', 'remove'])]
    private ?Cabinet $cabinet = null;

    public function __construct()
    {
        $this->teamChiefs = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, TeamChief>
     */
    public function getTeamChiefs(): Collection
    {
        return $this->teamChiefs;
    }

    public function addTeamChief(TeamChief $teamChief): static
    {
        if (!$this->teamChiefs->contains($teamChief)) {
            $this->teamChiefs->add($teamChief);
            $teamChief->setDirector($this);
        }

        return $this;
    }

    public function removeTeamChief(TeamChief $teamChief): static
    {
        if ($this->teamChiefs->removeElement($teamChief)) {
            // set the owning side to null (unless already changed)
            if ($teamChief->getDirector() === $this) {
                $teamChief->setDirector(null);
            }
        }

        return $this;
    }

    public function getCabinet(): ?Cabinet
    {
        return $this->cabinet;
    }

    public function setCabinet(?Cabinet $cabinet): static
    {
        // unset the owning side of the relation if necessary
        if ($cabinet === null && $this->cabinet !== null) {
            $this->cabinet->setDirector(null);
        }

        // set the owning side of the relation if necessary
        if ($cabinet !== null && $cabinet->getDirector() !== $this) {
            $cabinet->setDirector($this);
        }

        $this->cabinet = $cabinet;

        return $this;
    }
}
