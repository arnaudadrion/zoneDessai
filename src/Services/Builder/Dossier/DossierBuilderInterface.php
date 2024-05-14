<?php

namespace App\Services\Builder\Dossier;

interface DossierBuilderInterface
{
    public function setType();
    public function setName();
    public function getDossier();
}