<?php

namespace App\Controller\Survey;

use App\Entity\Survey\Survey;
use App\Form\SurveyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/survey/question', name: 'survey_question_')]
class QuestionController extends AbstractController
{
    #[Route('/index/{id}', name: 'index')]
    public function index(Survey $survey): Response
    {

        return $this->render('survey/question_index.html.twig', ['survey' => $survey]);
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
//        $form = $this->createForm(SurveyType::class, $survey);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager->flush();
//
//            return $this->redirectToRoute('survey_index', [], Response::HTTP_SEE_OTHER);
//        }
//
//        return $this->render('survey/edit.html.twig', [
//            'survey' => $survey,
//            'form' => $form,
//        ]);
    }
}