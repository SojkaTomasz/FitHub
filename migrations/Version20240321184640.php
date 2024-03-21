<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240321184640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, weight NUMERIC(5, 2) NOT NULL, calf_circumference NUMERIC(5, 2) NOT NULL, thigh_circumference NUMERIC(5, 2) NOT NULL, belt_circumference NUMERIC(5, 2) NOT NULL, chest_circumference NUMERIC(5, 2) NOT NULL, neck_circumference NUMERIC(5, 2) NOT NULL, biceps_circumference NUMERIC(5, 2) NOT NULL, forearm_circumference NUMERIC(5, 2) NOT NULL, percent_diet INT NOT NULL, comments LONGTEXT DEFAULT NULL, date DATETIME NOT NULL, front_img VARCHAR(255) NOT NULL, side_img VARCHAR(255) NOT NULL, back_img VARCHAR(255) NOT NULL, INDEX IDX_C42F7784CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784CB944F1A FOREIGN KEY (student_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784CB944F1A');
        $this->addSql('DROP TABLE report');
    }
}
