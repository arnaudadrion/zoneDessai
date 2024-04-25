<?php

namespace App\Controller\Cabinet;

use App\Builder\CabinetBuilder;
use App\Builder\HierarchyBuilder;
use App\Repository\Cabinet\CabinetRepository;
use App\Repository\Cabinet\CollaboratorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cabinet', name: 'cabinet_')]
class CabinetController extends AbstractController
{
    #[Route('/{cabinetId}', name: 'index')]
    public function index(
        CabinetRepository $repository,
        CabinetBuilder $builder,
        HierarchyBuilder $hierarchyBuilder,
        CollaboratorRepository $collabRepository,
        EntityManagerInterface $em,
        $cabinetId
    ) : Response
    {
        $cabinet = $builder->build($cabinetId, $hierarchyBuilder);

//        $organigramme = $collabRepository->childrenHierarchy(
//            null,
//            false,
//            [
//                'decorate' => true,
//                'rootOpen' => '<ul>',
//                'rootClose' => '</ul>',
//                'childOpen' => '<li>',
//                'childClose' => '</li>',
//                'nodeDecorator' => function($node) {
//                    return '<p>'.$node->getUser()->getFullname().'</p>';
//                }
//            ]
//        );

        return $this->render('cabinet/index.html.twig', [
            'cabinet' => $cabinet,
//            'organigramme' => $organigramme
        ]);
    }


    public function organigrammeAction()
    {

    }
}