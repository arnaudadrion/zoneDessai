<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CabinetInfosFixture extends Fixture
{
    public const CABINET_INFOS_REFERENCE = 'cabinet_infos_reference';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {

    }
}