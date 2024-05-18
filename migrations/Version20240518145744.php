<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240518145744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info ADD new_student_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE info ADD CONSTRAINT FK_CB89315716ABACD6 FOREIGN KEY (new_student_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CB89315716ABACD6 ON info (new_student_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info DROP FOREIGN KEY FK_CB89315716ABACD6');
        $this->addSql('DROP INDEX IDX_CB89315716ABACD6 ON info');
        $this->addSql('ALTER TABLE info DROP new_student_id');
    }
}
