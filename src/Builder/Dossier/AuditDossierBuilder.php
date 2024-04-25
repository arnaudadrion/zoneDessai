<?php

namespace App\Builder\Dossier;

class AuditDossierBuilder extends AbstractDossierBuilder
{
    public function __construct()
    {
        $this->dossier = new AuditDossier();
    }

    public function getDossier()
    {
        return $this->dossier;
    }
}