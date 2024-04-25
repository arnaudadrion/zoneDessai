<?php

namespace App\Builder\Dossier;

use App\Factory\Dossier\InvestmentDossier;

class InvestmentDossierBuilder extends AbstractDossierBuilder
{

    public function __construct()
    {
        $this->dossier = new InvestmentDossier();
    }

    public function getDossier()
    {
        return $this->dossier;
    }

}