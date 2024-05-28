<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240524194340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questionnaire CHANGE preferred_training preferred_training JSON NOT NULL, CHANGE disliked_training disliked_training JSON NOT NULL, CHANGE available_equipment available_equipment JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questionnaire CHANGE preferred_training preferred_training VARCHAR(255) NOT NULL, CHANGE disliked_training disliked_training VARCHAR(255) NOT NULL, CHANGE available_equipment available_equipment VARCHAR(255) NOT NULL');
    }
}
