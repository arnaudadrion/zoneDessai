<?php

namespace App\DataFixtures;

use App\Entity\Cabinet\Dossier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DossierFixtures extends Fixture
{
    public const DOSSIER_INVESTISSEMENT_REFERENCE = 'dossier_investissement_reference';
    public const DOSSIER_AUDIT_REFERENCE = 'dossier_audit_reference';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $cabinet = $this->getReference(CabinetFixtures::CABINET_REFERENCE);

        $dossierInvestissement = new Dossier();
        $dossierInvestissement->setCabinet($cabinet);
        $manager->persist($dossierInvestissement);

        $dossierAudit = new Dossier();
        $dossierAudit->setCabinet($cabinet);
        $manager->persist($dossierAudit);

        $manager->flush();

        $this->addReference(self::DOSSIER_INVESTISSEMENT_REFERENCE, $dossierInvestissement);
        $this->addReference(self::DOSSIER_AUDIT_REFERENCE, $dossierAudit);
    }
}