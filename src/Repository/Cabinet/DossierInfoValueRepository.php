<?php

namespace App\Repository\Cabinet;

use App\Entity\Cabinet\DossierInfoValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DossierInfoValue>
 *
 * @method DossierInfoValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method DossierInfoValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method DossierInfoValue[]    findAll()
 * @method DossierInfoValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DossierInfoValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DossierInfoValue::class);
    }
}
