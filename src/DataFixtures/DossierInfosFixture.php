<?php

namespace App\DataFixtures;

use App\Entity\Cabinet\DossierInfos;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DossierInfosFixture extends Fixture
{
    public const CAPITAL = 'capital_reference';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $capital = new DossierInfos();
        $capital->setName('capital');
        $manager->persist($capital);

        $this->addReference(self::CAPITAL, $capital);
    }
}