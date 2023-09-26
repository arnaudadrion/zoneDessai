<?php

namespace App\Factory\Dossier;

interface DossierInterface
{
    public function createAuditDossier();

    public function createInvestmentDossier();
}