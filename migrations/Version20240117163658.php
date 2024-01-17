<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240117163658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE test.question (id INT AUTO_INCREMENT NOT NULL, survey_id INT NOT NULL, label VARCHAR(255) DEFAULT NULL, weight DOUBLE PRECISION NOT NULL, transchain VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_C44C958EB3FE509D (survey_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE test.question ADD CONSTRAINT FK_C44C958EB3FE509D FOREIGN KEY (survey_id) REFERENCES survey (id)');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES test.question (id)');
        $this->addSql('ALTER TABLE question_choice ADD CONSTRAINT FK_C6F6759A1E27F6BF FOREIGN KEY (question_id) REFERENCES test.question (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test.question DROP FOREIGN KEY FK_C44C958EB3FE509D');
        $this->addSql('DROP TABLE test.question');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE question_choice DROP FOREIGN KEY FK_C6F6759A1E27F6BF');
    }
}
