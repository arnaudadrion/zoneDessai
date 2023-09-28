<?php

namespace App\Factory\Dossier;

use App\Factory\Dossier\AbstractDossierFactory;

class InvestmentDossierFactory extends AbstractDossierFactory
{

    public function factoryMethod()
    {
        return new InvestmentDossier();
    }
}