<?php

namespace App\Builder\Dossier;

use App\Builder\Dossier\DossierBuilderInterface;
use App\Repository\Cabinet\DossierInfosRepository;

Abstract class AbstractDossierBuilder implements DossierBuilderInterface
{
    private Dossier $dossier;
    private DossierInfosRepository $repository;
    private int $dossierId;

    private array $data;

    public function __construct($dossierId, DossierInfosRepository $dossierInfosRepository)
    {
        $this->dossierId = $dossierId;
        $this->repository = $dossierInfosRepository;
    }

    public function initData()
    {
        $this->data = $this->repository->getAllValuesByDossier();
    }

    public function setType(string $type)
    {
        $this->dossier->setType($this->data['type']);
    }

    public function setName(string $name)
    {
        $this->dossier->setName($name);
    }

    abstract public function getDossier();
}