<?php

namespace App\Entity\Survey\Question;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TextareaQuestionRepository::class)
 */
class TextareaQuestion extends AbstractQuestion
{
}
