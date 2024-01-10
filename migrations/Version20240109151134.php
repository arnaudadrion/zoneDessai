<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109151134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cabinet_infos (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cabinet_infos_value (id_cabinet_infos INT NOT NULL, id_value INT NOT NULL, INDEX IDX_F331899C5565CED0 (id_cabinet_infos), INDEX IDX_F331899CF3F21904 (id_value), PRIMARY KEY(id_cabinet_infos, id_value)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cabinet_infos_value ADD CONSTRAINT FK_F331899C5565CED0 FOREIGN KEY (id_cabinet_infos) REFERENCES cabinet_infos (id)');
        $this->addSql('ALTER TABLE cabinet_infos_value ADD CONSTRAINT FK_F331899CF3F21904 FOREIGN KEY (id_value) REFERENCES cabinet (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cabinet_infos_value DROP FOREIGN KEY FK_F331899C5565CED0');
        $this->addSql('ALTER TABLE cabinet_infos_value DROP FOREIGN KEY FK_F331899CF3F21904');
        $this->addSql('DROP TABLE cabinet_infos');
        $this->addSql('DROP TABLE cabinet_infos_value');
    }
}
