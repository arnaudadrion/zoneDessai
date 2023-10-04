<?php

namespace App\Controller\Cabinet;

use App\Builder\CabinetBuilder;
use App\Builder\HierarchyBuilder;
use App\Repository\CabinetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cabinet', name: 'cabinet_')]
class CabinetController extends AbstractController
{
    #[Route('/{cabinetId}', name: 'index')]
    public function index(CabinetRepository $repository, CabinetBuilder $builder, HierarchyBuilder $hierarchyBuilder, $cabinetId)
    {
        $cabinet = $builder->build($cabinetId, $repository, $hierarchyBuilder);

        return $this->render('cabinet/index.html.twig', [
            'cabinet' => $cabinet
        ]);
    }
}