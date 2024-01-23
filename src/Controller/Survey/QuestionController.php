<?php

namespace App\Controller\Survey;

use App\Entity\Survey\Survey;
use App\Entity\Survey\Question\DateQuestion;
use App\Entity\Survey\Question\EmailQuestion;
use App\Entity\Survey\Question\TextQuestion;
use App\Entity\Survey\Question\TextareaQuestion;
use App\Entity\Survey\Question\BooleanQuestion;
use App\Entity\Survey\Question\IntegerQuestion;
use App\Entity\Survey\Question\ChoiceQuestion;
use App\Entity\Survey\Question\SelectQuestion;
use App\Entity\Survey\Question\MultipleChoiceQuestion;
use App\Entity\Survey\Question\FloatQuestion;
use App\Form\Survey\AbstractQuestionType;
use App\Repository\Survey\SurveyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    #[Route('/new-type/{surveyId}', name: 'new_type', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        SurveyRepository $surveyRepository,
        $surveyId
    ): Response
    {
        $survey = $surveyRepository->findOneById($surveyId);

        if ($request->getMethod() === 'POST') {
            $class = $request->request->all()['type'];

            return $this->redirectToRoute('survey_question_new_question', ['surveyId' => $surveyId, 'type' => $class]);
        }

        return $this->render('survey/question_new.html.twig', [
            'survey' => $survey
        ]);
    }

    #[Route('/new-question/{surveyId}/{type}', name: 'new_question', methods: ['GET', 'POST'])]
    public function new2(
        Request $request,
        EntityManagerInterface $entityManager,
        SurveyRepository $surveyRepository,
        $surveyId,
        $type
    ): Response
    {
        $survey = $surveyRepository->findOneById($surveyId);
        $class = "App\Entity\Survey\Question\\" . $type;

        $question = new $class();

        $question->setSurvey($survey);
        $form = $this->createForm(AbstractQuestionType::class, $question);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('survey_question_index', ['id' => $surveyId], Response::HTTP_SEE_OTHER);
        }

        return $this->render('survey/question_new2.html.twig', [
            'survey' => $survey,
            'form' => $form
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