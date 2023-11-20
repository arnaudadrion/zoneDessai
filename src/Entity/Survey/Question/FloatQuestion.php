<?php

namespace App\Entity\Survey\Question;

use App\Repository\Survey\Question\FloatQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FloatQuestionRepository::class)]
class FloatQuestion extends AbstractQuestion
{
}
