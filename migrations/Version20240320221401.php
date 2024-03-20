<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240320221401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, weight NUMERIC(5, 2) NOT NULL, calf_circumference NUMERIC(5, 2) NOT NULL, thigh_circumference NUMERIC(5, 2) NOT NULL, belt_circumference NUMERIC(5, 2) NOT NULL, neck_circumference NUMERIC(5, 2) NOT NULL, biceps_circumference NUMERIC(5, 2) NOT NULL, forearm_circumference NUMERIC(5, 2) NOT NULL, date DATETIME NOT NULL, comments LONGTEXT DEFAULT NULL, percent_diet INT NOT NULL, INDEX IDX_C42F7784CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784CB944F1A FOREIGN KEY (student_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6A76ED395');
        $this->addSql('DROP TABLE review');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, opinia SMALLINT NOT NULL, INDEX IDX_794381C6A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784CB944F1A');
        $this->addSql('DROP TABLE report');
    }
}
