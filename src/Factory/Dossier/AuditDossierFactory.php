<?php

namespace App\Factory\Dossier;

use App\Factory\Dossier\AbstractDossierFactory;

class AuditDossierFactory extends AbstractDossierFactory
{
    public function factoryMethod()
    {
        return new AuditDossier();
    }
}