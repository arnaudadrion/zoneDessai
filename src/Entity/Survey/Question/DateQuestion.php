<?php

namespace App\Entity\Survey\Question;

use App\Repository\Survey\Question\DateQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DateQuestionRepository::class)]
class DateQuestion extends AbstractQuestion
{
}
