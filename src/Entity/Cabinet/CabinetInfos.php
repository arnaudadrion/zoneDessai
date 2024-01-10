<?php

namespace App\Entity\Cabinet;

use App\Repository\Cabinet\CabinetInfosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Entity(repositoryClass: CabinetInfosRepository::class)]
class CabinetInfos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'idCabinetInfos', targetEntity: CabinetInfosValue::class)]
    private Collection $cabinetInfosValues;

    public function __construct()
    {
        $this->cabinetInfosValues = new ArrayCollection();
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
     * @return Collection<int, CabinetInfosValue>
     */
    public function getCabinetInfosValues(): Collection
    {
        return $this->cabinetInfosValues;
    }

    public function addCabinetInfosValues(CabinetInfosValue $cabinetInfosValues): static
    {
        if (!$this->cabinetInfosValues->contains($cabinetInfosValues)) {
            $this->cabinetInfosValues->add($cabinetInfosValues);
            $cabinetInfosValues->setIdCabinetInfos($this);
        }

        return $this;
    }

    public function removeIdCabinet(CabinetInfosValue $cabinetInfosValues): static
    {
        if ($this->cabinetInfosValues->removeElement($cabinetInfosValues)) {
            // set the owning side to null (unless already changed)
            if ($cabinetInfosValues->getIdCabinetInfos() === $this) {
                $cabinetInfosValues->setIdCabinetInfos(null);
            }
        }

        return $this;
    }
}
