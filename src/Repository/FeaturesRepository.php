<?php

namespace App\Repository;

use App\Entity\Features;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Features>
 *
 * @method Features|null find($id, $lockMode = null, $lockVersion = null)
 * @method Features|null findOneBy(array $criteria, array $orderBy = null)
 * @method Features[]    findAll()
 * @method Features[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeaturesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Features::class);
    }

    public function findDatatableData(
        ?int $firstResult,
        ?int $maxResults,
        array $orderBy,
        array $columns,
        array $search
    ): array
    {
        $query = $this->createQueryBuilder('f')
            ->setFirstResult($firstResult)
            ->setMaxResults($maxResults);

        foreach ($orderBy as $order) {
            $query->orderBy('f.'.$order['name'], $order['dir']);
        }

        foreach ($columns as $key => $column) {
            if ($column['search']['value'] !== '') {
                $query->andWhere('f.'.$column['name'].' LIKE \'%'.$column['search']['value'].'%\'');
            }
        }

        return $query->getQuery()->getResult();
    }
}
