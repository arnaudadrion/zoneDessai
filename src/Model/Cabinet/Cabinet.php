<?php

namespace App\Model\Cabinet;

use App\Entity\Cabinet\Cabinet as Entity;
use Doctrine\Common\Collections\ArrayCollection;

class Cabinet
{
    private $id;

    private $name;

    private $collaborators;

    private $dossiers;

    public function __construct(Entity $entity)
    {
        $this->dossiers = new ArrayCollection();
        $this->setId($entity->getId());
        $this->setName($entity->getName());
    }

    public function setId ($id)
    {
        $this->id = $id;
    }

    public function getId ()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setCollaborators(ArrayCollection $collaborators)
    {
        $this->collaborators = $collaborators;
    }

    public function getCollaborators() : ArrayCollection
    {
        return $this->collaborators;
    }

    public function openDossier ()
    {

    }
}