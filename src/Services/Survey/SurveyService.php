<?php

namespace App\Services\Survey;

use App\Entity\Survey\Survey;
use App\Entity\User;
use App\Repository\Survey\Answer\AnswerRepository;
use App\Repository\Survey\SurveyRepository;

class SurveyService
{
    public function __construct(
        private AnswerRepository $answerRepository,
        private SurveyRepository $surveyRepository
    ) {
    }

    public function getUserAnswers(User $user, Survey $survey)
    {
        return $this->answerRepository->findByUserAndSurvey($user, $survey);
    }

    public function getSurveyScore(User $user, Survey $survey)
    {
        $totalScore = 0;
        $totalMaximumScore = 0;

        $answers = $this->getUserAnswers($user, $survey);
        foreach ($answers as $answer) {
            $answerScore = (float)$answer->getScore();
            $questionWeight = $answer->getQuestion()->getWeight();
            $maximumScore = (float)$answer->getQuestion()->getMaximumScore();

            $totalScore += $answerScore * $questionWeight;
            $totalMaximumScore += $maximumScore * $questionWeight;
        }

        return $totalMaximumScore > 0 ? $totalScore / $totalMaximumScore : 0;
    }
}