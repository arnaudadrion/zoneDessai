<?php

namespace App\DataFixtures;

use App\Entity\Cabinet\DossierInfos;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DossierInfosFixture extends Fixture
{
    public const NAME = 'name';
    public const TYPE = 'type';
    public const CAPITAL = 'capital_reference';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $name = new DossierInfos();
        $name->setName('name');
        $manager->persist($name);

        $type = new DossierInfos();
        $type->setName('type');
        $manager->persist($type);

        $capital = new DossierInfos();
        $capital->setName('capital');
        $manager->persist($capital);



        $manager->flush();

        $this->addReference(self::NAME, $name);
        $this->addReference(self::TYPE, $type);
        $this->addReference(self::CAPITAL, $capital);
    }
}