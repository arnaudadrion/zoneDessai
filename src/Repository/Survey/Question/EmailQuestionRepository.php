<?php

namespace App\Repository\Survey\Question;

use App\Entity\Survey\Question\AbstractQuestion;
use App\Entity\Survey\Question\ChoiceQuestion;
use App\Entity\Survey\Question\DateQuestion;
use App\Entity\Survey\Question\EmailQuestion;
use App\Entity\Survey\Question\SelectQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AbstractQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method AbstractQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method AbstractQuestion[]    findAll()
 * @method AbstractQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmailQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmailQuestion::class);
    }
}