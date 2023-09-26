<?php

namespace App\Composite\CabinetHierarchy;

use Doctrine\Common\Collections\ArrayCollection;

abstract class Collaborator
{
    protected $parent;

    protected ArrayCollection $children;


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