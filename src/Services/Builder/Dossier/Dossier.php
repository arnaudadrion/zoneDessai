<?php

namespace App\Services\Builder\Dossier;

use App\Repository\Cabinet\DossierInfoValueRepository;

class Dossier
{
    private string $name;
    private string $type;

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