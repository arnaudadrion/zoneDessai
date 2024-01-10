<?php

namespace App\Repository\Cabinet;

use App\Entity\Cabinet\CabinetInfosValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CabinetInfosValue>
 *
 * @method CabinetInfosValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method CabinetInfosValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method CabinetInfosValue[]    findAll()
 * @method CabinetInfosValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CabinetInfosValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CabinetInfosValue::class);
    }

//    /**
//     * @return CabinetInfosValue[] Returns an array of CabinetInfosValue objects
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

//    public function findOneBySomeField($value): ?CabinetInfosValue
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
