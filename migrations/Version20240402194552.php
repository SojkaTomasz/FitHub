<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240402194552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report_analysis ADD trainer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE report_analysis ADD CONSTRAINT FK_535E4DFB08EDF6 FOREIGN KEY (trainer_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_535E4DFB08EDF6 ON report_analysis (trainer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report_analysis DROP FOREIGN KEY FK_535E4DFB08EDF6');
        $this->addSql('DROP INDEX IDX_535E4DFB08EDF6 ON report_analysis');
        $this->addSql('ALTER TABLE report_analysis DROP trainer_id');
    }
}
