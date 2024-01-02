<?php

namespace App\Controller\Survey;

use App\Entity\Survey\Survey;
use App\Form\SurveyType;
use App\Repository\Survey\SurveyRepository;
use App\Services\XML\XMLTranslation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/survey', name: 'survey_')]
class SurveyController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function indexAction (SurveyRepository $surveyRepository)
    {
        return $this->render('survey/index.html.twig', ['surveys' => $surveyRepository->findAll(),]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, XMLTranslation $xml): Response
    {
        $survey = new Survey();
        $form = $this->createForm(SurveyType::class, $survey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $docsInfo = ['transchain' => $form->getData()->getTranschain(), 'langs' => ['fr', 'en']];
            $name = $form->getData()->getName();

            $toAdd = ['fr' => ['source' => $name, 'target' => $name],
                      'en' => ['source' => $name, 'target' => $request->request->all()['survey']['traduction']]
                      ];

            $realTranschain = $xml->addTranslation($docsInfo, $toAdd);

            if ($realTranschain !== $form->getData()->getTranschain()) {
                $survey->setTranschain($realTranschain);
            }

            $entityManager->persist($survey);
            $entityManager->flush();

            return $this->redirectToRoute('survey_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('survey/new.html.twig', [
            'survey' => $survey,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Survey $survey): Response
    {
        return $this->render('survey/show.html.twig', [
            'survey' => $survey,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Survey $survey, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SurveyType::class, $survey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('survey_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('survey/edit.html.twig', [
            'survey' => $survey,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(Request $request, Survey $survey, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$survey->getId(), $request->request->get('_token'))) {
            $entityManager->remove($survey);
            $entityManager->flush();
        }

        return $this->redirectToRoute('survey_index', [], Response::HTTP_SEE_OTHER);
    }
}