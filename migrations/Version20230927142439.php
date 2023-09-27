<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230927142439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE audit (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, cabinet_id INT DEFAULT NULL, team_chief_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_9218FF79A76ED395 (user_id), INDEX IDX_9218FF79D351EC (cabinet_id), INDEX IDX_9218FF79C239B49F (team_chief_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cabinet (id INT AUTO_INCREMENT NOT NULL, director_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_4CED05B0899FB366 (director_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE director (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_1E90D3F0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_chief (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, director_id INT DEFAULT NULL, cabinet_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_DA79C70CA76ED395 (user_id), INDEX IDX_DA79C70C899FB366 (director_id), INDEX IDX_DA79C70CD351EC (cabinet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF79A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF79D351EC FOREIGN KEY (cabinet_id) REFERENCES cabinet (id)');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF79C239B49F FOREIGN KEY (team_chief_id) REFERENCES team_chief (id)');
        $this->addSql('ALTER TABLE cabinet ADD CONSTRAINT FK_4CED05B0899FB366 FOREIGN KEY (director_id) REFERENCES director (id)');
        $this->addSql('ALTER TABLE director ADD CONSTRAINT FK_1E90D3F0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE team_chief ADD CONSTRAINT FK_DA79C70CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE team_chief ADD CONSTRAINT FK_DA79C70C899FB366 FOREIGN KEY (director_id) REFERENCES director (id)');
        $this->addSql('ALTER TABLE team_chief ADD CONSTRAINT FK_DA79C70CD351EC FOREIGN KEY (cabinet_id) REFERENCES cabinet (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audit DROP FOREIGN KEY FK_9218FF79A76ED395');
        $this->addSql('ALTER TABLE audit DROP FOREIGN KEY FK_9218FF79D351EC');
        $this->addSql('ALTER TABLE audit DROP FOREIGN KEY FK_9218FF79C239B49F');
        $this->addSql('ALTER TABLE cabinet DROP FOREIGN KEY FK_4CED05B0899FB366');
        $this->addSql('ALTER TABLE director DROP FOREIGN KEY FK_1E90D3F0A76ED395');
        $this->addSql('ALTER TABLE team_chief DROP FOREIGN KEY FK_DA79C70CA76ED395');
        $this->addSql('ALTER TABLE team_chief DROP FOREIGN KEY FK_DA79C70C899FB366');
        $this->addSql('ALTER TABLE team_chief DROP FOREIGN KEY FK_DA79C70CD351EC');
        $this->addSql('DROP TABLE audit');
        $this->addSql('DROP TABLE cabinet');
        $this->addSql('DROP TABLE director');
        $this->addSql('DROP TABLE team_chief');
    }
}
