<?php

namespace App\DataFixtures;

use App\Entity\Cabinet\Dossier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DossierFixtures extends Fixture
{
    public const DOSSIER_INVESTISSEMENT_REFERENCE = 'dossier_investissement_reference';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $dossierInvestissement = new Dossier();

        $manager->persist($dossierInvestissement);
        $manager->flush();

        $this->addReference(self::DOSSIER_INVESTISSEMENT_REFERENCE, $dossierInvestissement);
    }
}