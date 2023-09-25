<?php

namespace App\Controller;

use App\Repository\FeaturesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'front')]
    public function frontAction(FeaturesRepository $repository) : Response
    {
        $features = $repository->findAll();
        return $this->render('front.html.twig', ['features' => $features]);
    }
}