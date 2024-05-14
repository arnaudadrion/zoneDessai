<?php

namespace App\Services\Builder\Dossier;

use App\Repository\Cabinet\DossierInfosRepository;

Abstract class AbstractDossierBuilder implements DossierBuilderInterface
{
    protected Dossier $dossier;
    private DossierInfosRepository $repository;
    private int $dossierId;

    protected array $data;

    public function __construct(DossierInfosRepository $dossierInfosRepository)
    {
        $this->repository = $dossierInfosRepository;
    }

    public function init($dossierId): void
    {
        $this->dossierId = $dossierId;
        $this->data = $this->repository->getAllValuesByDossier($this->dossierId);
        $dossierClass = $class = 'App\Services\Builder\Dossier\\'.ucfirst($this->data['type']).'Dossier';
        $this->dossier = new $dossierClass();
    }

    public function setType(): void
    {
        $this->dossier->setType($this->data['type']);
    }

    public function setName(): void
    {
        $this->dossier->setName($this->data['name']);
    }

    abstract public function getDossier();
}