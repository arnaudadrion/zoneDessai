<?php

namespace App\Entity\Survey\Question;

use App\Repository\Survey\Question\BooleanQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BooleanQuestionRepository::class)
 */
class BooleanQuestion extends AbstractQuestion
{
}
