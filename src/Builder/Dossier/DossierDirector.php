<?php

namespace App\Builder\Dossier;

class DossierDirector
{
    public function build(DossierBuilderInterface $builder)
    {

        return $builder->getDossier();
    }
}