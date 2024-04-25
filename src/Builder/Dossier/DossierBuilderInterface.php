<?php

namespace App\Builder\Dossier;

interface DossierBuilderInterface
{
    public function setType(string $type);
    public function setName(string $name);
    public function getDossier();
}