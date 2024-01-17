<?php

namespace App\Entity\Survey\Question;

use App\Repository\Survey\Question\TextareaQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TextareaQuestionRepository::class)]
class TextareaQuestion extends AbstractQuestion
{
}
