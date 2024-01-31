<?php

namespace App\DataFixtures;

use App\Entity\Cabinet\CabinetInfos;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CabinetInfosFixture extends Fixture
{
    public const CODE_POSTAL_REFERENCE = 'code_postal_reference';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $codePostal = new CabinetInfos();
        $codePostal->setName('Code postal');

        $manager->persist($codePostal);
        $manager->flush();

        $this->addReference(self::CODE_POSTAL_REFERENCE, $codePostal);
    }
}