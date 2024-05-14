<?php

namespace App\Services\Builder\Dossier;

use AllowDynamicProperties;
use App\Factory\Dossier\InvestmentDossier;
use App\Repository\Cabinet\DossierInfosRepository;

#[AllowDynamicProperties]
class InvestmentDossierBuilder extends AbstractDossierBuilder
{
    public function build()
    {
        $this->setName();
        $this->setType();
        return $this->dossier;
    }

    public function getDossier()
    {
        return $this->dossier;
    }

}