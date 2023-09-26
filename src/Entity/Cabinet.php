<?php

namespace App\Entity;

use App\Repository\CabinetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CabinetRepository::class)]
class Cabinet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'cabinet', targetEntity: Audit::class)]
    private Collection $audits;

    #[ORM\OneToOne(inversedBy: 'cabinet', cascade: ['persist', 'remove'])]
    private ?Director $director = null;

    #[ORM\OneToMany(mappedBy: 'cabinet', targetEntity: TeamChief::class)]
    private Collection $TeamChiefs;

    public function __construct()
    {
        $this->audits = new ArrayCollection();
        $this->TeamChiefs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Audit>
     */
    public function getAudits(): Collection
    {
        return $this->audits;
    }

    public function addAudit(Audit $audit): static
    {
        if (!$this->audits->contains($audit)) {
            $this->audits->add($audit);
            $audit->setCabinet($this);
        }

        return $this;
    }

    public function removeAudit(Audit $audit): static
    {
        if ($this->audits->removeElement($audit)) {
            // set the owning side to null (unless already changed)
            if ($audit->getCabinet() === $this) {
                $audit->setCabinet(null);
            }
        }

        return $this;
    }

    public function getDirector(): ?Director
    {
        return $this->director;
    }

    public function setDirector(?Director $director): static
    {
        $this->director = $director;

        return $this;
    }

    /**
     * @return Collection<int, TeamChief>
     */
    public function getTeamChiefs(): Collection
    {
        return $this->TeamChiefs;
    }

    public function addTeamChief(TeamChief $teamChief): static
    {
        if (!$this->TeamChiefs->contains($teamChief)) {
            $this->TeamChiefs->add($teamChief);
            $teamChief->setCabinet($this);
        }

        return $this;
    }

    public function removeTeamChief(TeamChief $teamChief): static
    {
        if ($this->TeamChiefs->removeElement($teamChief)) {
            // set the owning side to null (unless already changed)
            if ($teamChief->getCabinet() === $this) {
                $teamChief->setCabinet(null);
            }
        }

        return $this;
    }
}
