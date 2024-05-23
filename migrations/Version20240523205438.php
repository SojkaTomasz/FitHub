<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523205438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questionnaire DROP past_sports, DROP allergies, DROP medications, DROP dietary_preferences');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questionnaire ADD past_sports LONGTEXT DEFAULT NULL, ADD allergies VARCHAR(255) NOT NULL, ADD medications VARCHAR(255) NOT NULL, ADD dietary_preferences VARCHAR(255) NOT NULL');
    }
}
