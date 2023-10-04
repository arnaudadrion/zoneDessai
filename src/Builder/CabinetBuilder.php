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
        $this->cabinet = new Cabinet();
        $this->cabinet->setEntity($entity);
    }

    public function buildHierarchy(HierarchyBuilder $builder)
    {
        $hierarchy = $builder->build($this->cabinet->getEntity()->getId());

        $this->cabinet->setHierarchy($hierarchy);
    }

    public function addDossiers(Cabinet $cabinet)
    {

    }
}