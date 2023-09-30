<?php

namespace App\Controller\Admin;

use App\Entity\Features;
use App\Form\FeatureType;
use App\Repository\FeaturesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_features_')]
class AdminController extends AbstractController
{
    #[Route('/list-features', name: 'list')]
    public function listFeaturesAction(
        Request $request,
        DataTableFactory $dataTableFactory
    ) : Response
    {
        $table = $dataTableFactory->create()
            ->add('title', TextColumn::class, [
                'label' => 'Titre',
                'orderable' => true,
            ])
            ->add('content', TextColumn::class, [
                'label' => 'Descriptif'
            ])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Features::class,
            ])
            ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }

        return $this->render('admin/index.html.twig', [
            'datatable' => $table,
        ]);
    }

    public function data(Request $request, FeaturesRepository $repository)
    {
        if ($request->getMethod() === 'POST') {
            $draw = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $orders = $request->get('order', []);
            $columns = $request->get('columns', []);
            $search = $request->get('search', []);
        } else {
            throw new \HttpException();
        }

        // ADD COLUMN NAME IN ORDER ARRAY
        foreach ($orders as $key => $order) {
            $orders[$key]['name'] = $columns[$order['column']]['name'];
        }

        $objects = $repository->findDatatableData($start, $length, $orders, $columns, $search);
        $totalObjects = $repository->count([]);
        $totalFilteredObjects = count($objects);

        $response = [
            'draw' => $draw,
            'recordsTotal' => $totalObjects,
            'recordsFiltered' => $totalFilteredObjects,
            'data' => [],
        ];

        $propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()
            ->enableExceptionOnInvalidIndex()
            ->getPropertyAccessor();

        foreach ($objects as $object) {
            $objectData = [];

            foreach ($columns as $column) {
                $value = $propertyAccessor->getValue($object, $column['name']);
                $objectData[] = $value;
            }

            $response['data'][] = $objectData;
        }

        return new JsonResponse($response);
    }

    #[Route('/add-feature', name: 'add')]
    public function addFeatureAction(Request $request, EntityManagerInterface $em,)
    {
        $newFeature = new Features();
        $form = $this->createForm(FeatureType::class, $newFeature);

        $form->handleRequest($request);
        if ($form->isSubmitted() &&$form->isValid()) {
            $em->persist($newFeature);
            $em->flush();

            return $this->redirectToRoute('admin_features_list');
        }

        return $this->render('admin/new.html.twig', [
           'form' => $form->createView()
        ]);
    }
}