<?php

namespace App\Composite\CabinetHierarchy;

use App\Composite\CabinetHierarchy\Collaborator;

class TeamChief extends Collaborator
{
    public function ascendentOperation()
    {
        return "J'envoie des rapports au Directeur";
    }

    public function descendentOperation()
    {
        return "Je récupère les rapports de l'équipe et je répercute les ordres du Directeur";
    }
}