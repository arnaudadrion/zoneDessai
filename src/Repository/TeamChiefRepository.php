<?php

namespace App\Repository;

use App\Entity\TeamChief;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TeamChief>
 *
 * @method TeamChief|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeamChief|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeamChief[]    findAll()
 * @method TeamChief[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamChiefRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TeamChief::class);
    }

//    /**
//     * @return TeamChief[] Returns an array of TeamChief objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TeamChief
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
