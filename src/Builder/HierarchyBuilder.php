<?php

namespace App\Builder;

use App\Repository\Cabinet\CollaboratorRepository;
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
        foreach ($collaborators as $collaborator)
        {
            $isExists = $this->verifyExistence($hierarchy, $collaborator->getUser());

            $class = $collaborator->getClass();
            $collab = new $class($collaborator);

            if (!$isExists) {
                $hierarchy->add($collab);
            }

            if ($collaborator->getChildren()) {
                $this->createChildren($collaborator->getChildren(), $collab, $hierarchy);
            }
        }

        return $hierarchy;
    }

    public function createChildren($collaborators, $parent, &$hierarchy)
    {
        foreach ($collaborators as $child) {
            $isExists = $this->verifyExistence($hierarchy, $child->getUser());

            $class = $child->getClass();
            $collab = new $class($child);

            if (!$isExists) {
                $parent->addChild($collab);
                $collab->setParent($parent);
                $hierarchy->add($collab);
            }

            if ($child->getChildren()) {
                $this->createChildren($child->getChildren(), $collab, $hierarchy);
            }
        }
    }

    private function verifyExistence($hierarchy, $user)
    {
        $name = $user->getFullName();

        return $hierarchy->exists(function($key, $value) use ($name){
            return $value->getName() === $name;
        });;
    }
}