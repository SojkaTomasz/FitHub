<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240524192357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questionnaire CHANGE training_days training_days VARCHAR(255) NOT NULL, CHANGE training_hours training_hours VARCHAR(255) NOT NULL, CHANGE current_training current_training VARCHAR(255) NOT NULL, CHANGE meals_per_day meals_per_day VARCHAR(255) NOT NULL, CHANGE snacking_habits snacking_habits VARCHAR(255) NOT NULL, CHANGE preferred_training preferred_training VARCHAR(255) NOT NULL, CHANGE disliked_training disliked_training VARCHAR(255) NOT NULL, CHANGE available_equipment available_equipment VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questionnaire CHANGE training_days training_days SMALLINT NOT NULL, CHANGE training_hours training_hours SMALLINT NOT NULL, CHANGE current_training current_training LONGTEXT DEFAULT NULL, CHANGE meals_per_day meals_per_day SMALLINT NOT NULL, CHANGE snacking_habits snacking_habits LONGTEXT DEFAULT NULL, CHANGE preferred_training preferred_training LONGTEXT NOT NULL, CHANGE disliked_training disliked_training LONGTEXT NOT NULL, CHANGE available_equipment available_equipment LONGTEXT DEFAULT NULL');
    }
}
