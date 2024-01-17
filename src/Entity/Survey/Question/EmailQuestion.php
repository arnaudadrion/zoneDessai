<?php

namespace App\Entity\Survey\Question;

use App\Repository\Survey\Question\EmailQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmailQuestionRepository::class)]
class EmailQuestion extends AbstractQuestion
{
}