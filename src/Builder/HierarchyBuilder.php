<?php

namespace App\Builder;

use App\Composite\CabinetHierarchy\Director;
use App\Composite\CabinetHierarchy\TeamChief;
use App\Composite\CabinetHierarchy\Audit;
use App\Model\Cabinet\Cabinet;
use App\Repository\CollaboratorRepository;
use Doctrine\Common\Collections\ArrayCollection;

class HierarchyBuilder
{
    public function __construct(private CollaboratorRepository $repository)
    {

    }

    public function build($cabinetId)
    {
        $collaborators = $this->repository->findBy(['cabinet' => $cabinetId]);

        return $this->createHierarchy($collaborators);;
    }

    public function createHierarchy ($collaborators)
    {
        $hierarchy = new ArrayCollection();
        foreach ($collaborators as $key => $collaborator)
        {
            $class = $collaborator->getClass();
            $collab = new $class($collaborator);

            if ($key === 0) {
                $hierarchy->add($collab);
            }

            if ($collaborator->getChildren()) {
                $this->createChildren($collaborator->getChildren(), $collab);
            }
        }

        return $hierarchy;
    }

    public function createChildren($collaborators, $parent)
    {
        foreach ($collaborators as $child) {
            $class = $child->getClass();
            $collab = new $class($child);
            $parent->addChild($collab);
            $collab->setParent($parent);

            if ($child->getChildren()) {
                $this->createChildren($child->getChildren(), $collab);
            }
        }
    }
}