<?php

namespace App\DataFixtures;

use App\Entity\Cabinet\DossierInfoValue;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DossierInfoValueFixtures extends Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $cabinet = $this->getReference(CabinetFixtures::CABINET_REFERENCE);

        $dossierAudit = $this->getReference(DossierFixtures::DOSSIER_AUDIT_REFERENCE);
        $dossierInvestment = $this->getReference(DossierFixtures::DOSSIER_INVESTISSEMENT_REFERENCE);

        $name = $this->getReference(DossierInfosFixture::NAME);
        $type = $this->getReference(DossierInfosFixture::TYPE);
        $capital = $this->getReference(DossierInfosFixture::CAPITAL);

        $nameAudit = new DossierInfoValue();
        $nameAudit->setIdDossier($dossierAudit);
        $nameAudit->setIdDossierInfo($name);
        $nameAudit->setValue('Dossier Audit');
        $manager->persist($nameAudit);

        $nameInvestment = new DossierInfoValue();
        $nameInvestment->setIdDossier($dossierInvestment);
        $nameInvestment->setIdDossierInfo($name);
        $nameInvestment->setValue('Dossier Investissement');
        $manager->persist($nameInvestment);

        $typeAudit = new DossierInfoValue();
        $typeAudit->setIdDossier($dossierAudit);
        $typeAudit->setIdDossierInfo($type);
        $typeAudit->setValue('Audit');
        $manager->persist($typeAudit);

        $typeInvestment = new DossierInfoValue();
        $typeInvestment->setIdDossier($dossierInvestment);
        $typeInvestment->setIdDossierInfo($type);
        $typeInvestment->setValue('Investment');
        $manager->persist($typeInvestment);
    }
}