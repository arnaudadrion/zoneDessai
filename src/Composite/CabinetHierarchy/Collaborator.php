<?php

namespace App\Composite\CabinetHierarchy;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

abstract class Collaborator
{
    private User $user;

    private $parent;

    private ArrayCollection $children;


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