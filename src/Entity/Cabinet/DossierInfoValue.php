<?php

namespace App\Entity\Cabinet;

use App\Repository\Cabinet\DossierInfoValueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DossierInfoValueRepository::class)]
class DossierInfoValue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'dossierInfoValues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Dossier $idDossier = null;

    #[ORM\ManyToOne(inversedBy: 'dossierInfoValues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DossierInfos $idDossierInfo = null;

    #[ORM\Column(length: 255)]
    private ?string $value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDossier(): ?Dossier
    {
        return $this->idDossier;
    }

    public function setIdDossier(?Dossier $idDossier): static
    {
        $this->idDossier = $idDossier;

        return $this;
    }

    public function getIdDossierInfo(): ?DossierInfos
    {
        return $this->idDossierInfo;
    }

    public function setIdDossierInfo(?DossierInfos $idDossierInfo): static
    {
        $this->idDossierInfo = $idDossierInfo;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }
}
