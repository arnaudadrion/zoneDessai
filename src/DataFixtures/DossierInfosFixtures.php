<?php

namespace App\DataFixtures;

use App\Entity\Cabinet\DossierInfos;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DossierInfosFixtures extends Fixture
{
    public const NAME_REFERENCE = 'name_reference';
    public const TYPE_REFERENCE = 'type_reference';
    public const CAPITAL_REFERENCE = 'capital_reference';

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

        $this->addReference(self::NAME_REFERENCE, $name);
        $this->addReference(self::TYPE_REFERENCE, $type);
        $this->addReference(self::CAPITAL_REFERENCE, $capital);
    }
}