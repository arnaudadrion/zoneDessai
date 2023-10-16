<?php

namespace App\DataFixtures;

use App\Entity\Collaborator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CollaboratorsFixtures extends Fixture implements DependentFixtureInterface
{
    public const COLLABORATORS_REFERENCE = 'collaborators_reference';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $cabinet = $this->getReference(CabinetFixtures::CABINET_REFERENCE);

        $director = new Collaborator();
        $director->setClass('Director');
        $director->setJob('Directeur du cabinet Test');
        $director->setCabinet($cabinet);
        $director->setUser($this->getReference(UserFixtures::USER_DIRECTOR));

        $teamChief1 = new Collaborator();
        $teamChief1->setCabinet($cabinet);
        $teamChief1->setClass('TeamChief');
        $teamChief1->setJob('Chef de l\'équipe 1');
        $teamChief1->setParent($director);
        $teamChief1->setUser($this->getReference(UserFixtures::USER_TEAMCHIEF_1));

        $teamChief2 = new Collaborator();
        $teamChief2->setCabinet($cabinet);
        $teamChief2->setClass('TeamChief');
        $teamChief2->setJob('Chef de l\'équipe 2');
        $teamChief2->setParent($director);
        $teamChief2->setUser($this->getReference(UserFixtures::USER_TEAMCHIEF_2));

        $director->addChild($teamChief1);
        $director->addChild($teamChief2);

        $audit1 = new Collaborator();
        $audit1->setCabinet($cabinet);
        $audit1->setClass('Audit');
        $audit1->setJob('Analyste de l\'équipe 1');
        $audit1->setParent($teamChief1);
        $audit1->setUser($this->getReference(UserFixtures::USER_AUDIT_1));

        $audit2 = new Collaborator();
        $audit2->setCabinet($cabinet);
        $audit2->setClass('Audit');
        $audit2->setJob('Analyste de l\'équipe 1');
        $audit2->setParent($teamChief1);
        $audit2->setUser($this->getReference(UserFixtures::USER_AUDIT_2));

        $teamChief1->addChild($audit1);
        $teamChief1->addChild($audit2);

        $audit3 = new Collaborator();
        $audit3->setCabinet($cabinet);
        $audit3->setClass('Audit');
        $audit3->setJob('Analyste de l\'équipe 2');
        $audit3->setParent($teamChief2);
        $audit3->setUser($this->getReference(UserFixtures::USER_AUDIT_3));

        $audit4 = new Collaborator();
        $audit4->setCabinet($cabinet);
        $audit4->setClass('Audit');
        $audit4->setJob('Analyste de l\'équipe 2');
        $audit4->setParent($teamChief2);
        $audit4->setUser($this->getReference(UserFixtures::USER_AUDIT_4));

        $teamChief2->addChild($audit3);
        $teamChief2->addChild($audit4);

        $manager->persist($director);
        $manager->persist($teamChief1);
        $manager->persist($teamChief2);
        $manager->persist($audit1);
        $manager->persist($audit2);
        $manager->persist($audit3);
        $manager->persist($audit4);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CabinetFixtures::class,
            UserFixtures::class
        ];
    }
}