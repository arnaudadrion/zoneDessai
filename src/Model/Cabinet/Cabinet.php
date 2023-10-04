<?php

namespace App\Model\Cabinet;

use App\Entity\Cabinet as Entity;
use Doctrine\Common\Collections\ArrayCollection;

class Cabinet
{
    private Entity $entity;

    private $hierarchy;

    private $dossiers;

    public function __construct()
    {
        $this->dossiers = new ArrayCollection();
    }

    public function setEntity (Entity $entity)
    {
        $this->entity = $entity;
    }

    public function getEntity ()
    {
        return $this->entity;
    }

    public function setHierarchy ($hierarchy)
    {
        $this->hierarchy = $hierarchy;
    }

    public function getHierarchy ()
    {
        return $this->hierarchy;
    }

    public function openDossier ()
    {

    }
}