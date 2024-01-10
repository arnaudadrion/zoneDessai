<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110130254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dossier (id INT AUTO_INCREMENT NOT NULL, cabinet_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_3D48E037D351EC (cabinet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier_info_value (id INT AUTO_INCREMENT NOT NULL, id_dossier_id INT NOT NULL, id_dossier_info_id INT NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_3954D9E4C4968C81 (id_dossier_id), INDEX IDX_3954D9E4F68FEB48 (id_dossier_info_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier_infos (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dossier ADD CONSTRAINT FK_3D48E037D351EC FOREIGN KEY (cabinet_id) REFERENCES cabinet (id)');
        $this->addSql('ALTER TABLE dossier_info_value ADD CONSTRAINT FK_3954D9E4C4968C81 FOREIGN KEY (id_dossier_id) REFERENCES dossier (id)');
        $this->addSql('ALTER TABLE dossier_info_value ADD CONSTRAINT FK_3954D9E4F68FEB48 FOREIGN KEY (id_dossier_info_id) REFERENCES dossier_infos (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dossier DROP FOREIGN KEY FK_3D48E037D351EC');
        $this->addSql('ALTER TABLE dossier_info_value DROP FOREIGN KEY FK_3954D9E4C4968C81');
        $this->addSql('ALTER TABLE dossier_info_value DROP FOREIGN KEY FK_3954D9E4F68FEB48');
        $this->addSql('DROP TABLE dossier');
        $this->addSql('DROP TABLE dossier_info_value');
        $this->addSql('DROP TABLE dossier_infos');
    }
}
