<?php

namespace App\Builder;

use App\Composite\CabinetHierarchy\Director;
use App\Repository\AuditRepository;
use App\Repository\DirectorRepository;
use App\Repository\TeamChiefRepository;

class HierarchyBuilder
{
    public function build($cabinet)
    {
        $direction = $this->buildDirection($cabinet, new DirectorRepository());

    }

    public function buildDirection($cabinet, DirectorRepository $repository)
    {
        $directors = $repository->findBy(['cabinet' => $cabinet]);

        foreach ($directors as $director) {
            $directeur = new Director();
        }
    }

    public function buildTeamChiefs(&$directors, TeamChiefRepository $repository)
    {

    }

    public function buildAudits(&$teamChiefs, AuditRepository $repository)
    {

    }
}