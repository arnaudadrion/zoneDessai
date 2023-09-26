<?php

namespace App\Composite\CabinetHierarchy;

use App\Composite\CabinetHierarchy\Collaborator;

class Director extends Collaborator
{
    public function descendentOperation()
    {
        return 'Je donne des ordres';
    }
}