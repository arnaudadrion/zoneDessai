<?php

namespace App\Entity\Survey\Question;

use App\Repository\Survey\Question\IntegerQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IntegerQuestionRepository::class)
 */
class IntegerQuestion extends AbstractQuestion
{
}
