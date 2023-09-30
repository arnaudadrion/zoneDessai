<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230929102819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cabinet DROP FOREIGN KEY FK_4CED05B0899FB366');
        $this->addSql('CREATE TABLE collaborator (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, user_id INT NOT NULL, cabinet_id INT NOT NULL, class VARCHAR(255) NOT NULL, INDEX IDX_606D487C727ACA70 (parent_id), UNIQUE INDEX UNIQ_606D487CA76ED395 (user_id), INDEX IDX_606D487CD351EC (cabinet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collaborator ADD CONSTRAINT FK_606D487C727ACA70 FOREIGN KEY (parent_id) REFERENCES collaborator (id)');
        $this->addSql('ALTER TABLE collaborator ADD CONSTRAINT FK_606D487CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE collaborator ADD CONSTRAINT FK_606D487CD351EC FOREIGN KEY (cabinet_id) REFERENCES cabinet (id)');
        $this->addSql('ALTER TABLE audit DROP FOREIGN KEY FK_9218FF79A76ED395');
        $this->addSql('ALTER TABLE audit DROP FOREIGN KEY FK_9218FF79C239B49F');
        $this->addSql('ALTER TABLE audit DROP FOREIGN KEY FK_9218FF79D351EC');
        $this->addSql('ALTER TABLE director DROP FOREIGN KEY FK_1E90D3F0A76ED395');
        $this->addSql('ALTER TABLE team_chief DROP FOREIGN KEY FK_DA79C70C899FB366');
        $this->addSql('ALTER TABLE team_chief DROP FOREIGN KEY FK_DA79C70CA76ED395');
        $this->addSql('ALTER TABLE team_chief DROP FOREIGN KEY FK_DA79C70CD351EC');
        $this->addSql('DROP TABLE audit');
        $this->addSql('DROP TABLE director');
        $this->addSql('DROP TABLE team_chief');
        $this->addSql('DROP INDEX UNIQ_4CED05B0899FB366 ON cabinet');
        $this->addSql('ALTER TABLE cabinet DROP director_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE audit (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, cabinet_id INT DEFAULT NULL, team_chief_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_9218FF79A76ED395 (user_id), INDEX IDX_9218FF79D351EC (cabinet_id), INDEX IDX_9218FF79C239B49F (team_chief_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE director (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_1E90D3F0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE team_chief (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, director_id INT DEFAULT NULL, cabinet_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_DA79C70CA76ED395 (user_id), INDEX IDX_DA79C70C899FB366 (director_id), INDEX IDX_DA79C70CD351EC (cabinet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF79A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF79C239B49F FOREIGN KEY (team_chief_id) REFERENCES team_chief (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF79D351EC FOREIGN KEY (cabinet_id) REFERENCES cabinet (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE director ADD CONSTRAINT FK_1E90D3F0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE team_chief ADD CONSTRAINT FK_DA79C70C899FB366 FOREIGN KEY (director_id) REFERENCES director (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE team_chief ADD CONSTRAINT FK_DA79C70CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE team_chief ADD CONSTRAINT FK_DA79C70CD351EC FOREIGN KEY (cabinet_id) REFERENCES cabinet (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE collaborator DROP FOREIGN KEY FK_606D487C727ACA70');
        $this->addSql('ALTER TABLE collaborator DROP FOREIGN KEY FK_606D487CA76ED395');
        $this->addSql('ALTER TABLE collaborator DROP FOREIGN KEY FK_606D487CD351EC');
        $this->addSql('DROP TABLE collaborator');
        $this->addSql('ALTER TABLE cabinet ADD director_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cabinet ADD CONSTRAINT FK_4CED05B0899FB366 FOREIGN KEY (director_id) REFERENCES director (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4CED05B0899FB366 ON cabinet (director_id)');
    }
}
