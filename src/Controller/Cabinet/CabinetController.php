<?php

namespace App\Controller\Cabinet;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cabinet', name: 'cabinet_')]
class CabinetController extends AbstractController
{
    #[Route('/{cabinet_slug}', name: 'index')]
    public function index($cabinetSlug)
    {

    }
}