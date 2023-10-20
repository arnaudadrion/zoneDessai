<?php

namespace App\Builder;

use App\Model\Cabinet\Cabinet;
use App\Repository\CabinetRepository;
use App\Repository\CollaboratorRepository;

class CabinetBuilder
{
    private $cabinet;

    public function __construct()
    {

    }

    public function build(int $cabinetId, CabinetRepository $cabinetRepository, HierarchyBuilder $builder) {
        $this->createCabinet($cabinetId, $cabinetRepository);

        $this->buildHierarchy($builder);
//        $this->addDossiers();

        return $this->cabinet;
    }

    public function createCabinet(int $cabinetId, CabinetRepository $cabinetRepository)
    {
        $entity = $cabinetRepository->findOneBy(['id' => $cabinetId]);
        $this->cabinet = new Cabinet($entity);
    }

    public function buildHierarchy(HierarchyBuilder $builder)
    {
        $collaborators = $builder->build($this->cabinet->getId());

        $this->cabinet->setCollaborators($collaborators);
    }

    public function addDossiers(Cabinet $cabinet)
    {

    }
}