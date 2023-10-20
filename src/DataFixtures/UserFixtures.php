<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const USER_DIRECTOR = 'user_director';
    public const USER_TEAMCHIEF_1 = 'user_teamchief_1';
    public const USER_TEAMCHIEF_2 = 'user_teamchief_2';
    public const USER_AUDIT_1 = 'user_audit_1';
    public const USER_AUDIT_2 = 'user_audit_2';
    public const USER_AUDIT_3 = 'user_audit_3';
    public const USER_AUDIT_4 = 'user_audit_4';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $userDirector = new User();
        $userDirector->setFirstname('Jean-Louis');
        $userDirector->setLastname('Machin');
        $userDirector->setEmail('machin@machin.com');
        $userDirector->setRoles(["ROLE_USER"]);
        $userDirector->setUsername('machin@machin.com');

        $userTeamchief1 = new User();
        $userTeamchief1->setFirstname('Jean-Michel');
        $userTeamchief1->setLastname('Truc');
        $userTeamchief1->setEmail('truc@machin.com');
        $userTeamchief1->setRoles(["ROLE_USER"]);
        $userTeamchief1->setUsername('truc@machin.com');

        $userTeamchief2 = new User();
        $userTeamchief2->setFirstname('Jean-René');
        $userTeamchief2->setLastname('Chouette');
        $userTeamchief2->setEmail('chouette@machin.com');
        $userTeamchief2->setRoles(["ROLE_USER"]);
        $userTeamchief2->setUsername('chouette@machin.com');

        $userAudit1 = new User();
        $userAudit1->setFirstname('Jean-Théodore');
        $userAudit1->setLastname('Zut');
        $userAudit1->setEmail('zut@machin.com');
        $userAudit1->setRoles(["ROLE_USER"]);
        $userAudit1->setUsername('zut@machin.com');

        $userAudit2 = new User();
        $userAudit2->setFirstname('Jean-Marie');
        $userAudit2->setLastname('Flute');
        $userAudit2->setEmail('flute@machin.com');
        $userAudit2->setRoles(["ROLE_USER"]);
        $userAudit2->setUsername('flute@machin.com');

        $userAudit3 = new User();
        $userAudit3->setFirstname('Jean-Frédéric');
        $userAudit3->setLastname('Berlingot');
        $userAudit3->setEmail('berlingot@machin.com');
        $userAudit3->setRoles(["ROLE_USER"]);
        $userAudit3->setUsername('berlingot@machin.com');

        $userAudit4 = new User();
        $userAudit4->setFirstname('Jean-Richard');
        $userAudit4->setLastname('Brignole');
        $userAudit4->setEmail('brignole@machin.com');
        $userAudit4->setRoles(["ROLE_USER"]);
        $userAudit4->setUsername('brignole@machin.com');

        $manager->persist($userDirector);
        $manager->persist($userTeamchief1);
        $manager->persist($userTeamchief2);
        $manager->persist($userAudit1);
        $manager->persist($userAudit2);
        $manager->persist($userAudit3);
        $manager->persist($userAudit4);

        $manager->flush();

        $this->addReference(self::USER_DIRECTOR, $userDirector);
        $this->addReference(self::USER_TEAMCHIEF_1, $userTeamchief1);
        $this->addReference(self::USER_TEAMCHIEF_2, $userTeamchief2);
        $this->addReference(self::USER_AUDIT_1, $userAudit1);
        $this->addReference(self::USER_AUDIT_2, $userAudit2);
        $this->addReference(self::USER_AUDIT_3, $userAudit3);
        $this->addReference(self::USER_AUDIT_4, $userAudit4);
    }
}