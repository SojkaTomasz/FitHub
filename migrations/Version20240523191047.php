<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523191047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questionnaire ADD goals VARCHAR(255) NOT NULL, ADD short_term_goals VARCHAR(255) NOT NULL, ADD long_term_goals VARCHAR(255) NOT NULL, ADD activity_level VARCHAR(255) NOT NULL, ADD past_sports LONGTEXT DEFAULT NULL, ADD current_training LONGTEXT DEFAULT NULL, ADD health_issues VARCHAR(255) NOT NULL, ADD mobility_issues VARCHAR(255) NOT NULL, ADD allergies VARCHAR(255) NOT NULL, ADD medications VARCHAR(255) NOT NULL, ADD stress_level VARCHAR(255) NOT NULL, ADD sleep_quality VARCHAR(255) NOT NULL, ADD current_diet LONGTEXT NOT NULL, ADD dietary_preferences VARCHAR(255) NOT NULL, ADD meals_per_day SMALLINT NOT NULL, ADD snacking_habits LONGTEXT DEFAULT NULL, ADD water_intake VARCHAR(255) NOT NULL, ADD alcohol_intake VARCHAR(255) NOT NULL, ADD smoking_habits VARCHAR(255) NOT NULL, ADD motivation VARCHAR(255) NOT NULL, ADD preferred_training LONGTEXT NOT NULL, ADD disliked_training LONGTEXT NOT NULL, ADD preferred_training_time VARCHAR(255) NOT NULL, ADD available_equipment LONGTEXT DEFAULT NULL, ADD additional_info LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questionnaire DROP goals, DROP short_term_goals, DROP long_term_goals, DROP activity_level, DROP past_sports, DROP current_training, DROP health_issues, DROP mobility_issues, DROP allergies, DROP medications, DROP stress_level, DROP sleep_quality, DROP current_diet, DROP dietary_preferences, DROP meals_per_day, DROP snacking_habits, DROP water_intake, DROP alcohol_intake, DROP smoking_habits, DROP motivation, DROP preferred_training, DROP disliked_training, DROP preferred_training_time, DROP available_equipment, DROP additional_info');
    }
}
