<?php

namespace App\Services\Builder\Dossier;

use App\Repository\Cabinet\DossierInfosRepository;

class DossierDirector
{
    private DossierBuilderInterface $builder;
    private DossierInfosRepository $repository;

    public function __construct(DossierInfosRepository $repository)
    {
        $this->repository = $repository;
    }

    public function build(int $dossierId)
    {
        $this->setBuilder($dossierId);
        $this->builder->init($dossierId);
        return $this->builder->build();
    }

    public function getBuilder($dossierId)
    {
        $type = $this->repository->getType($dossierId);
        $class = 'App\Services\Builder\Dossier\\'.ucfirst($type['value']).'DossierBuilder';

        return new $class($this->repository);
    }

    public function setBuilder($dossierId)
    {
        $this->builder = $this->getBuilder($dossierId);
    }
}