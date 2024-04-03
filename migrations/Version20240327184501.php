<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240327184501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE trainer_report_add_analysis (id INT AUTO_INCREMENT NOT NULL, report_id INT NOT NULL, comment LONGTEXT NOT NULL, date_analysis DATETIME NOT NULL, UNIQUE INDEX UNIQ_535E4D4BD2A4C0 (report_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trainer_report_add_analysis ADD CONSTRAINT FK_535E4D4BD2A4C0 FOREIGN KEY (report_id) REFERENCES report (id)');
        $this->addSql('ALTER TABLE report CHANGE comments comment LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trainer_report_add_analysis DROP FOREIGN KEY FK_535E4D4BD2A4C0');
        $this->addSql('DROP TABLE trainer_report_add_analysis');
        $this->addSql('ALTER TABLE report CHANGE comment comments LONGTEXT DEFAULT NULL');
    }
}
