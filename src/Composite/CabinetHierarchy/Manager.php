<?php

namespace App\Composite\CabinetHierarchy;

use App\Composite\CabinetHierarchy\Collaborator;

class Manager extends Collaborator
{
    public function ascendentOperation()
    {
        if ($this->getParent() !==  NULL) {
            return 'Je fais remonter ce qui doit être remonté à mon N+1';
        }

        return 'Je suis directeur et je n\'ai pas de N+1';
    }

    public function descendentOperation()
    {
        return 'Je manage mes subordonnés';
    }
}