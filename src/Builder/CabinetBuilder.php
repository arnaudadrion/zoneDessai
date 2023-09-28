<?php

namespace App\Builder;

use App\Model\Cabinet\Cabinet;
use App\Repository\CabinetRepository;

class CabinetBuilder
{
    public function build(int $cabinet, CabinetRepository $cabinetRepository) {
        $cabinet = $this->createCabinet($cabinet, $cabinetRepository);
        $this->buildHierarchy();
        $this->addDossiers();

        return $cabinet;
    }

    public function createCabinet(int $cabinet, CabinetRepository $cabinetRepository)
    {
        $data = $cabinetRepository->findOneById($cabinet);
    }

    public function buildHierarchy(Cabinet $cabinet, HierarchyBuilder $builder)
    {
        $hierachy = $builder->build();
        $cabinet->addHierachy($hierachy);
    }

    public function addDossiers(Cabinet $cabinet)
    {

    }
}