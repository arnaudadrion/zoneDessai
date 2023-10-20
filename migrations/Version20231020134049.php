<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231020134049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collaborator DROP FOREIGN KEY FK_606D487C727ACA70');
        $this->addSql('ALTER TABLE collaborator ADD tree_root INT DEFAULT NULL, ADD lft INT NOT NULL, ADD lvl INT NOT NULL, ADD rgt INT NOT NULL');
        $this->addSql('ALTER TABLE collaborator ADD CONSTRAINT FK_606D487CA977936C FOREIGN KEY (tree_root) REFERENCES collaborator (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE collaborator ADD CONSTRAINT FK_606D487C727ACA70 FOREIGN KEY (parent_id) REFERENCES collaborator (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_606D487CA977936C ON collaborator (tree_root)');
        $this->addSql('ALTER TABLE user CHANGE password password VARCHAR(255) NOT NULL, CHANGE slug slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collaborator DROP FOREIGN KEY FK_606D487CA977936C');
        $this->addSql('ALTER TABLE collaborator DROP FOREIGN KEY FK_606D487C727ACA70');
        $this->addSql('DROP INDEX IDX_606D487CA977936C ON collaborator');
        $this->addSql('ALTER TABLE collaborator DROP tree_root, DROP lft, DROP lvl, DROP rgt');
        $this->addSql('ALTER TABLE collaborator ADD CONSTRAINT FK_606D487C727ACA70 FOREIGN KEY (parent_id) REFERENCES collaborator (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user CHANGE password password VARCHAR(255) DEFAULT NULL, CHANGE slug slug VARCHAR(255) DEFAULT NULL');
    }
}
