<?php

namespace App\DataFixtures;

use App\Entity\Cabinet;
use App\Entity\Collaborator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CabinetFixtures extends Fixture
{
    public const CABINET_REFERENCE = 'cabinet_reference';
    public function load(ObjectManager $manager): void
    {
        $cabinet = new Cabinet();
        $cabinet->setName('Cabinet test');

        $manager->persist($cabinet);
        $manager->flush();

        $this->addReference(self::CABINET_REFERENCE, $cabinet);
    }
}