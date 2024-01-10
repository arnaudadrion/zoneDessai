<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109171729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cabinet_infos_value DROP FOREIGN KEY FK_F331899C5565CED0');
        $this->addSql('ALTER TABLE cabinet_infos_value DROP FOREIGN KEY FK_F331899CF3F21904');
        $this->addSql('DROP INDEX IDX_F331899C5565CED0 ON cabinet_infos_value');
        $this->addSql('DROP INDEX IDX_F331899CF3F21904 ON cabinet_infos_value');
        $this->addSql('ALTER TABLE cabinet_infos_value ADD id INT AUTO_INCREMENT NOT NULL, ADD id_cabinet_infos_id INT NOT NULL, ADD id_cabinet_id INT NOT NULL, ADD value VARCHAR(255) NOT NULL, DROP id_cabinet_infos, DROP id_value, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE cabinet_infos_value ADD CONSTRAINT FK_F331899C83699F42 FOREIGN KEY (id_cabinet_infos_id) REFERENCES cabinet_infos (id)');
        $this->addSql('ALTER TABLE cabinet_infos_value ADD CONSTRAINT FK_F331899CA559D13B FOREIGN KEY (id_cabinet_id) REFERENCES cabinet (id)');
        $this->addSql('CREATE INDEX IDX_F331899C83699F42 ON cabinet_infos_value (id_cabinet_infos_id)');
        $this->addSql('CREATE INDEX IDX_F331899CA559D13B ON cabinet_infos_value (id_cabinet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cabinet_infos_value MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE cabinet_infos_value DROP FOREIGN KEY FK_F331899C83699F42');
        $this->addSql('ALTER TABLE cabinet_infos_value DROP FOREIGN KEY FK_F331899CA559D13B');
        $this->addSql('DROP INDEX IDX_F331899C83699F42 ON cabinet_infos_value');
        $this->addSql('DROP INDEX IDX_F331899CA559D13B ON cabinet_infos_value');
        $this->addSql('DROP INDEX `PRIMARY` ON cabinet_infos_value');
        $this->addSql('ALTER TABLE cabinet_infos_value ADD id_cabinet_infos INT NOT NULL, ADD id_value INT NOT NULL, DROP id, DROP id_cabinet_infos_id, DROP id_cabinet_id, DROP value');
        $this->addSql('ALTER TABLE cabinet_infos_value ADD CONSTRAINT FK_F331899C5565CED0 FOREIGN KEY (id_cabinet_infos) REFERENCES cabinet_infos (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE cabinet_infos_value ADD CONSTRAINT FK_F331899CF3F21904 FOREIGN KEY (id_value) REFERENCES cabinet (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F331899C5565CED0 ON cabinet_infos_value (id_cabinet_infos)');
        $this->addSql('CREATE INDEX IDX_F331899CF3F21904 ON cabinet_infos_value (id_value)');
        $this->addSql('ALTER TABLE cabinet_infos_value ADD PRIMARY KEY (id_cabinet_infos, id_value)');
    }
}
