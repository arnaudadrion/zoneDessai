<?php

namespace App\Entity\Survey\Question;

use App\Repository\Survey\Question\TextQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DateQuestionRepository::class)
 */
class DateQuestion extends AbstractQuestion
{
}
