<?php

namespace App\Services\Builder\Dossier;

use AllowDynamicProperties;
use App\Repository\Cabinet\DossierInfosRepository;

#[AllowDynamicProperties]
class AuditDossierBuilder extends AbstractDossierBuilder
{

    public function build(): AuditDossier
    {
        $this->setName();
        $this->setType();
        return $this->getDossier();
    }

    public function getDossier()
    {
        return $this->dossier;
    }
}