<?php

namespace App\Entity\Cabinet;

use App\Repository\Cabinet\DossierInfosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DossierInfosRepository::class)]
class DossierInfos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'idDossierInfo', targetEntity: DossierInfoValue::class)]
    private Collection $dossierInfoValues;

    public function __construct()
    {
        $this->dossierInfoValues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, DossierInfoValue>
     */
    public function getDossierInfoValues(): Collection
    {
        return $this->dossierInfoValues;
    }

    public function addDossierInfoValue(DossierInfoValue $dossierInfoValue): static
    {
        if (!$this->dossierInfoValues->contains($dossierInfoValue)) {
            $this->dossierInfoValues->add($dossierInfoValue);
            $dossierInfoValue->setIdDossierInfo($this);
        }

        return $this;
    }

    public function removeDossierInfoValue(DossierInfoValue $dossierInfoValue): static
    {
        if ($this->dossierInfoValues->removeElement($dossierInfoValue)) {
            // set the owning side to null (unless already changed)
            if ($dossierInfoValue->getIdDossierInfo() === $this) {
                $dossierInfoValue->setIdDossierInfo(null);
            }
        }

        return $this;
    }
}
