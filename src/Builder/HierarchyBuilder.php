<?php

namespace App\Builder;

use App\Composite\CabinetHierarchy\Director;
use App\Composite\CabinetHierarchy\TeamChief;
use App\Composite\CabinetHierarchy\Audit;
use App\Repository\CollaboratorRepository;
use Doctrine\Common\Collections\ArrayCollection;

class HierarchyBuilder
{
    private $repository;

    public function __construct (CollaboratorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function build($cabinet)
    {
//        $direction = $this->buildDirection($cabinet);
        $collaborators = $this->repository->findBy(['cabinet' => $cabinet]);
        $hierarchy = new ArrayCollection();

        $this->createHierarchy($collaborators, $hierarchy);
    }

    public function createHierarchy ($collaborators, $parent)
    {
        foreach ($collaborators as $collaborator)
        {
            $class = $collaborator->getClass();
            $collab = new $class();
            $parent->add($collab);

            if ($collaborator->getChildren()) {
                $parent = $collab;
            }
        }
    }
}