<?php

namespace App\Entity;

use App\Repository\AuditRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuditRepository::class)]
class Audit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'audit', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'audits')]
    private ?Cabinet $cabinet = null;

    #[ORM\ManyToOne(inversedBy: 'audits')]
    private ?TeamChief $teamChief = null;

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

    public function getCabinet(): ?Cabinet
    {
        return $this->cabinet;
    }

    public function setCabinet(?Cabinet $cabinet): static
    {
        $this->cabinet = $cabinet;

        return $this;
    }

    public function getTeamChief(): ?TeamChief
    {
        return $this->teamChief;
    }

    public function setTeamChief(?TeamChief $teamChief): static
    {
        $this->teamChief = $teamChief;

        return $this;
    }
}
