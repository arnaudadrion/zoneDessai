<?php

namespace App\Builder\Dossier;

use App\Builder\Dossier\DossierBuilderInterface;

Abstract class AbstractDossier implements DossierBuilderInterface
{
    private string $name;
    private string $type;

    private $dossier;

    public function __construct(Dossier $dossier)
    {
        $this->dossier = $dossier;
    }
    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setName(string $name)
    {
        $this->name =$name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDossier()
    {
        return $this->dossier;
    }
}