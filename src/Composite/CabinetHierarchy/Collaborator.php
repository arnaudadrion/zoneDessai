<?php

namespace App\Composite\CabinetHierarchy;

use App\Entity\Collaborator as Entity;
use Doctrine\Common\Collections\ArrayCollection;

abstract class Collaborator
{
    private Entity $entity;

    private $parent;

    private ArrayCollection $children;

    public function __construct($entity)
    {
        $this->setEntity($entity);
    }

    public function setEntity ($entity)
    {
        $this->entity = $entity;
    }

    public function getEntity ()
    {
        return $this->entity;
    }

    public function setParent(?Collaborator $parent)
    {
        $this->parent = $parent;
    }

    public function getParent(): Collaborator
    {
        return $this->parent;
    }

    public function add(Collaborator $collaborator): void
    {
        $this->children->add($collaborator);
    }

    public function remove(Collaborator $collaborator): void
    {
        $this->children->removeElement($collaborator);
    }

    public function ascendentOperation() {}

    public function descendentOperation() {}
}