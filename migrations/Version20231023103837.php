<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231023103837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collaborator DROP FOREIGN KEY FK_606D487CA977936C');
        $this->addSql('DROP INDEX IDX_606D487CA977936C ON collaborator');
        $this->addSql('ALTER TABLE collaborator CHANGE tree_root root INT DEFAULT NULL');
        $this->addSql('ALTER TABLE collaborator ADD CONSTRAINT FK_606D487C16F4F95B FOREIGN KEY (root) REFERENCES collaborator (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_606D487C16F4F95B ON collaborator (root)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collaborator DROP FOREIGN KEY FK_606D487C16F4F95B');
        $this->addSql('DROP INDEX IDX_606D487C16F4F95B ON collaborator');
        $this->addSql('ALTER TABLE collaborator CHANGE root tree_root INT DEFAULT NULL');
        $this->addSql('ALTER TABLE collaborator ADD CONSTRAINT FK_606D487CA977936C FOREIGN KEY (tree_root) REFERENCES collaborator (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_606D487CA977936C ON collaborator (tree_root)');
    }
}
