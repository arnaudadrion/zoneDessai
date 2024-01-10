<?php

namespace App\Entity\Cabinet;

use App\Repository\Cabinet\CabinetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: CabinetRepository::class)]
class Cabinet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'cabinet', targetEntity: Collaborator::class)]
    private Collection $collaborators;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Gedmo\Slug(fields: ['name'])]
    #[ORM\Column(length: 255, unique: true)]
    private string $slug;

    #[ORM\OneToMany(mappedBy: 'idCabinet', targetEntity: CabinetInfosValue::class)]
    private Collection $cabinetInfosValues;

    #[ORM\OneToMany(mappedBy: 'cabinet', targetEntity: Dossier::class)]
    private Collection $dossiers;


    public function __construct()
    {
        $this->collaborators = new ArrayCollection();
        $this->cabinetInfosValues = new ArrayCollection();
        $this->dossiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Collaborator>
     */
    public function getCollaborators(): Collection
    {
        return $this->collaborators;
    }

    public function addCollaborator(Collaborator $collaborator): static
    {
        if (!$this->collaborators->contains($collaborator)) {
            $this->collaborators->add($collaborator);
            $collaborator->setCabinet($this);
        }

        return $this;
    }

    public function removeCollaborator(Collaborator $collaborator): static
    {
        if ($this->collaborators->removeElement($collaborator)) {
            // set the owning side to null (unless already changed)
            if ($collaborator->getCabinet() === $this) {
                $collaborator->setCabinet(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, CabinetInfosValue>
     */
    public function getCabinetInfosValues(): Collection
    {
        return $this->cabinetInfosValues;
    }

    public function addCabinetInfosValue(CabinetInfosValue $cabinetInfosValue): static
    {
        if (!$this->cabinetInfosValues->contains($cabinetInfosValue)) {
            $this->cabinetInfosValues->add($cabinetInfosValue);
            $cabinetInfosValue->setIdCabinet($this);
        }

        return $this;
    }

    public function removeCabinetInfosValue(CabinetInfosValue $cabinetInfosValue): static
    {
        if ($this->cabinetInfosValues->removeElement($cabinetInfosValue)) {
            // set the owning side to null (unless already changed)
            if ($cabinetInfosValue->getIdCabinet() === $this) {
                $cabinetInfosValue->setIdCabinet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dossier>
     */
    public function getDossiers(): Collection
    {
        return $this->dossiers;
    }

    public function addDossier(Dossier $dossier): static
    {
        if (!$this->dossiers->contains($dossier)) {
            $this->dossiers->add($dossier);
            $dossier->setCabinet($this);
        }

        return $this;
    }

    public function removeDossier(Dossier $dossier): static
    {
        if ($this->dossiers->removeElement($dossier)) {
            // set the owning side to null (unless already changed)
            if ($dossier->getCabinet() === $this) {
                $dossier->setCabinet(null);
            }
        }

        return $this;
    }
}
