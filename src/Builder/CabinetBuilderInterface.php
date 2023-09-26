<?php

namespace App\Builder;

use App\Model\Cabinet\Cabinet;

interface CabinetBuilderInterface
{
    public function createCabinet(int $cabinet);

    public function buildHierarchy(Cabinet $cabinet);

    public function addDossiers(Cabinet $cabinet);
}