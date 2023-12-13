<?php

namespace App\DataFixtures;

use App\Entity\Features;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FeaturesFixtures extends Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $cabinet = $this->getReference(CabinetFixtures::CABINET_REFERENCE);

        $feature1 = new Features();
        $feature1->setTitle('Liste des features');
        $feature1->setContent('Liste des features');
        $feature1->setLink('admin_features_list');

        $feature2 = new Features();
        $feature2->setTitle('Shop nosql');
        $feature2->setContent('Catégories à partir d\'un fichier json');
        $feature2->setLink('shop_nosql_index');

        $feature3 = new Features();
        $feature3->setTitle('Cabinet');
        $feature3->setContent('Cabinet générique pour tester des design pattern');
        $feature3->setLink('cabinet_index');
        $feature3->setParameters(['cabinetId' => $cabinet->getId()]);

        $feature4 = new Features();
        $feature4->setTitle('Survey');
        $feature4->setContent('Système de formualaire dynamique');
        $feature4->setLink('survey_index');

        $feature5 = new Features();
        $feature5->setTitle('FrontEnd');
        $feature5->setContent('Zone de test frontend');
        $feature5->setLink('css_index');

        $manager->persist($feature1);
        $manager->persist($feature2);
        $manager->persist($feature3);
        $manager->persist($feature4);
        $manager->persist($feature5);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CabinetFixtures::class,
        ];
    }
}
