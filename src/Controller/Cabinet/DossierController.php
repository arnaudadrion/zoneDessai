<?php

declare(strict_types=1);

namespace App\Controller\Cabinet;

use App\Services\Builder\Dossier\DossierDirector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dossier', name: 'dossier_')]
class DossierController extends AbstractController
{

    #[Route('/{dossierId}', name: 'index')]
    public function index(int $dossierId, DossierDirector $director): Response
    {
        $dossier = $director->build($dossierId);

        return $this->render('dossier/index.html.twig', ['dossier' => $dossier]);
    }
}
