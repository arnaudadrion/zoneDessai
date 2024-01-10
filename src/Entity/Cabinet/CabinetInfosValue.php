<?php

namespace App\Entity\Cabinet;

use App\Repository\Cabinet\CabinetInfosValueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CabinetInfosValueRepository::class)]
class CabinetInfosValue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cabinetInfosValues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CabinetInfos $idCabinetInfos = null;

    #[ORM\ManyToOne(inversedBy: 'cabinetInfosValues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cabinet $idCabinet = null;

    #[ORM\Column(length: 255)]
    private ?string $value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCabinetInfos(): ?CabinetInfos
    {
        return $this->idCabinetInfos;
    }

    public function setIdCabinetInfos(?CabinetInfos $idCabinetInfos): static
    {
        $this->idCabinetInfos = $idCabinetInfos;

        return $this;
    }

    public function getIdCabinet(): ?Cabinet
    {
        return $this->idCabinet;
    }

    public function setIdCabinet(?Cabinet $idCabinet): static
    {
        $this->idCabinet = $idCabinet;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}
