<?php

namespace App\Controller\CssTest;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/css', name: 'css_')]
class CssController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function indexAction(){
        return $this->render('css/index.html.twig');
    }
}