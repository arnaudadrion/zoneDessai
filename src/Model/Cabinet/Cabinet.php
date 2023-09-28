<?php

namespace App\Model\Cabinet;

use Doctrine\Common\Collections\ArrayCollection;

class Cabinet
{
    private string $name;

    private $hierachy;

    private $dossiers;

    public function __construct()
    {
        $this->hierachy = new ArrayCollection();
        $this->dossiers = new ArrayCollection();
    }

    public function setName ($name)
    {
        $this->name = $name;
    }

    public function getName ()
    {
        return $this->name;
    }

    public function setHierarchy ($hierachy)
    {
        $this->hierachy = $hierachy;
    }

    public function getHierachy ()
    {
        return $this->hierarchy;
    }

    public function openDossier ()
    {

    }
}