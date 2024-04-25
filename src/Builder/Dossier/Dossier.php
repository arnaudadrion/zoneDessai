<?php

namespace App\Builder\Dossier;

use App\Repository\Cabinet\DossierInfoValueRepository;

abstract class Dossier
{
    private string $name;
    private string $type;
    private DossierInfoValueRepository $dossierInfosValue;
    public function __construct(DossierInfoValueRepository $dossierInfosValue) {
        $this->dossierInfosValue = $dossierInfosValue;
    }

    public function setName(string $name): Dossier
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setType(string $type): Dossier
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }
}