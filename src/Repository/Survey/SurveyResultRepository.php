<?php

namespace App\Repository\Survey;

use App\Entity\Survey\SurveyResult;
use App\Enum\SurveyWistartEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SurveyResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method SurveyResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method SurveyResult[]    findAll()
 * @method SurveyResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SurveyResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SurveyResult::class);
    }

    public function findWistartSurveys()
    {
        $qb = $this->createQueryBuilder('s');
        $qb->add('where', $qb->expr()->in('s.slug', ':wistartSurveys'))
            ->setParameter('wistartSurveys', SurveyWistartEnum::getWistartSurveys());

        return $qb->getQuery()->getResult();
    }
}
