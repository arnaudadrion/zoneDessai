<?php

namespace App\Repository\Cabinet;

use App\Entity\Cabinet\CabinetInfos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CabinetInfos>
 *
 * @method CabinetInfos|null find($id, $lockMode = null, $lockVersion = null)
 * @method CabinetInfos|null findOneBy(array $criteria, array $orderBy = null)
 * @method CabinetInfos[]    findAll()
 * @method CabinetInfos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CabinetInfosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CabinetInfos::class);
    }

//    /**
//     * @return CabinetInfos[] Returns an array of CabinetInfos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CabinetInfos
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
