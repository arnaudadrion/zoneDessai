<?php

namespace App\Builder\Dossier;

interface DossierBuilderInterface
{
    public function setType(string $type);
    public function getType();
}