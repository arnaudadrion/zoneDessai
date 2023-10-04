<?php

namespace App\Composite\CabinetHierarchy;

use App\Entity\Collaborator as Entity;
use Doctrine\Common\Collections\ArrayCollection;

abstract class Collaborator
{
    private int $collabId;

    private string $name;

    private string $email;

    private Collaborator $parent;

    private ArrayCollection $children;

    public function __construct($entity)
    {
        $this->children = new ArrayCollection();
        $this->setCollabId($entity->getId());
        $this->setName($entity->getUser()->getFullname());
        $this->setEmail($entity->getUser()->getEmail());
    }

    public function setCollabId($id)
    {
        $this->collabId = $id;
    }

    public function getCollabId()
    {
        return $this->collabId;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setParent(?Collaborator $parent)
    {
        $this->parent = $parent;
    }

    public function getParent(): Collaborator
    {
        return $this->parent;
    }

    public function addChild(Collaborator $collaborator): void
    {
        $this->children->add($collaborator);
    }

    public function removeChild(Collaborator $collaborator): void
    {
        $this->children->removeElement($collaborator);
    }

    public function getChildren(): ArrayCollection
    {
        return $this->children;
    }

    public function ascendentOperation() {}

    public function descendentOperation() {}
}