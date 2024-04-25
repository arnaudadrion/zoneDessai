<?php

namespace App\Repository\Cabinet;

use App\Entity\Cabinet\Cabinet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cabinet>
 *
 * @method Cabinet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cabinet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cabinet[]    findAll()
 * @method Cabinet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CabinetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cabinet::class);
    }

    public function getCabinetDossierName($cabinetId)
    {
        $result = $this->createQueryBuilder('c')
            ->select('d.id','di.name', 'div.value')
            ->innerjoin('c.dossiers', 'd')
            ->innerjoin('d.dossierInfoValues', 'div')
            ->innerJoin('div.idDossierInfo', 'di')
            ->where('c.id = :idCabinet')
            ->andWhere('di.name = :name')
            ->setParameter('idCabinet', $cabinetId)
            ->setParameter('name', 'name')
            ->getQuery()
            ->getResult();

        return new ArrayCollection($result);
    }
}
