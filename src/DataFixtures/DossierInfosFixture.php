<?php

namespace App\DataFixtures;

use App\Entity\Cabinet\DossierInfos;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DossierInfosFixture extends Fixture
{
    public const INVESTISSEMENT_TYPE = 'investissement_type';
    public const CAPITAL = 'capital_reference';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $type = new DossierInfos();
        $type->setName('type');

        $capital = new DossierInfos();
        $capital->setName('capital');

        $manager->persist($capital);
        $manager->flush();

        $this->addReference(self::CAPITAL, $capital);
    }
}