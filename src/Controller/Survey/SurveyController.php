<?php

namespace App\Controller\Survey;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/survey', name: 'survey_')]
class SurveyController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function indexAction () {
        return $this->render('survey/index.html.twig');
    }
}