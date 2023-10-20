<?php

namespace App\Repository;

use App\Entity\Collaborator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ManagerRegistry;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 *
 * @method Collaborator|null find($id, $lockMode = null, $lockVersion = null)
 * @method Collaborator|null findOneBy(array $criteria, array $orderBy = null)
 * @method Collaborator[]    findAll()
 * @method Collaborator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollaboratorRepository extends NestedTreeRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, new ClassMetadata(Collaborator::class));
    }
}
