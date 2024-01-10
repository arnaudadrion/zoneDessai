<?php

namespace App\Repository\Cabinet;

use App\Entity\Cabinet\DossierInfos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DossierInfos>
 *
 * @method DossierInfos|null find($id, $lockMode = null, $lockVersion = null)
 * @method DossierInfos|null findOneBy(array $criteria, array $orderBy = null)
 * @method DossierInfos[]    findAll()
 * @method DossierInfos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DossierInfosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DossierInfos::class);
    }

//    /**
//     * @return DossierInfos[] Returns an array of DossierInfos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DossierInfos
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
