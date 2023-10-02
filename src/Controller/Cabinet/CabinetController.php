<?php

namespace App\Controller\Cabinet;

use App\Repository\CabinetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cabinet', name: 'cabinet_')]
class CabinetController extends AbstractController
{
    #[Route('/{cabinetSlug}', name: 'index')]
    public function index(CabinetRepository $repository, $cabinetSlug)
    {
        $cabinet = $repository->findOneBy(['slug' => $cabinetSlug]);

        return $this->render('cabinet/index.html.twig', [
            'cabinet' => $cabinet
        ]);
    }
}