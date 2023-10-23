<?php

namespace App\Repository;

use App\Entity\Collaborator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;


class CollaboratorRepository extends NestedTreeRepository
{
    public function __construct(EntityManagerInterface $registry)
    {
        parent::__construct($registry, new ClassMetadata(Collaborator::class));
    }
}
