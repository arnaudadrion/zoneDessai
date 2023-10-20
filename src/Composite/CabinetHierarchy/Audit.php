<?php

namespace App\Composite\CabinetHierarchy;

use App\Composite\CabinetHierarchy\Collaborator;

class Audit extends Collaborator
{
    public function ascendentOperation()
    {
        return "J'analyse et écrit des rapport pour mon N+1";
    }

    public function descendentOperation()
    {
        return 'Je n\'ai pas de subordonés.';
    }
}