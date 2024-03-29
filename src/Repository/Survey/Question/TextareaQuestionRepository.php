<?php

namespace App\Repository\Survey\Question;

use App\Entity\Survey\Question\AbstractQuestion;
use App\Entity\Survey\Question\TextareaQuestion;
use App\Entity\Survey\Question\TextQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AbstractQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method AbstractQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method AbstractQuestion[]    findAll()
 * @method AbstractQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TextareaQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TextareaQuestion::class);
    }
}