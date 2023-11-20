<?php

namespace App\Entity\Survey\Question;

use App\Repository\Survey\Question\OrderQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderQuestionRepository::class)]
class OrderQuestion extends ChoiceQuestion
{

}
