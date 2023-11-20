<?php

namespace App\Repository\Survey;

use App\Entity\Survey\Survey;
use App\Enum\SurveyWistartEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Survey|null find($id, $lockMode = null, $lockVersion = null)
 * @method Survey|null findOneBy(array $criteria, array $orderBy = null)
 * @method Survey[]    findAll()
 * @method Survey[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SurveyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Survey::class);
    }

    /**
     * @return Survey[]
     */
    public function findWistartSurveys(): array
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->add('where', $qb->expr()->in('s.slug', ':wistartSurveys'))
            ->setParameter('wistartSurveys', SurveyWistartEnum::getWistartSurveys());

        return $qb->getQuery()->getResult();
    }
}
