<?php

namespace App\Controller\Survey;

use App\Entity\Survey\Question\BooleanQuestion;
use App\Entity\Survey\Survey;
use App\Form\AbstractQuestionType;
use App\Form\SurveyType;
use App\Repository\Survey\SurveyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Question\Question;
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

    #[Route('show/{id}', name: 'show', methods: ['GET'])]
    public function show(Question $question): Response
    {
        return $this->render('survey/question_show.html.twig', [
            'question' => $question,
        ]);
    }

    #[Route('/new/{surveyId}', name: 'new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        SurveyRepository $surveyRepository,
        $surveyId
    ): Response
    {
        $survey = $surveyRepository->findOneById($surveyId);
        $question = new BooleanQuestion();
        $question->setSurvey($survey);
        $form = $this->createForm(AbstractQuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('survey_question_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('survey/question_new.html.twig', [
            'question' => $question,
            'form' => $form,
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
}