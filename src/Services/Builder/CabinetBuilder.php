<?php

namespace App\Services\Builder;

use App\Model\Cabinet\Cabinet;
use App\Repository\Cabinet\CabinetRepository;

class CabinetBuilder
{
    private $cabinetRepository;
    private $entity;
    private $cabinet;

    public function __construct(CabinetRepository $cabinetRepository)
    {
        $this->cabinetRepository = $cabinetRepository;
    }

    public function build(int $cabinetId,  HierarchyBuilder $builder): Cabinet
    {
        $this->entity = $this->cabinetRepository->findOneBy(['id' => $cabinetId]);
        $this->createCabinet();

        $this->buildHierarchy($builder);
        $this->addDossiers();

        return $this->cabinet;
    }

    public function createCabinet()
    {
        $this->cabinet = new Cabinet($this->entity);
    }

    public function buildHierarchy(HierarchyBuilder $builder)
    {
        $collaborators = $builder->build($this->entity->getId());

        $this->cabinet->setCollaborators($collaborators);
    }

    public function addDossiers()
    {
        $dossiers = $this->cabinetRepository->getCabinetDossierName($this->entity->getId());

        $this->cabinet->setDossiers($dossiers);
    }

    public function getCabinet(): Cabinet
    {
        return $this->cabinet;
    }
}