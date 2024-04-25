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

   public function getAllValuesByDossier($dossierId)
    {
        return $this->createQueryBuilder('di')
                    ->select('di.name', 'div.value')
                    ->leftJoin('di.dossierInfoValues', 'div')
                    ->where('div.idDossier = :idDossier')
                    ->setParameter('idDossier', $dossierId)
                    ->getQuery()
                    ->getResult();
    }
}
