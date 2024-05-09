<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240509191144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info ADD report_id INT DEFAULT NULL, ADD reviews_id INT DEFAULT NULL, DROP action');
        $this->addSql('ALTER TABLE info ADD CONSTRAINT FK_CB8931574BD2A4C0 FOREIGN KEY (report_id) REFERENCES report (id)');
        $this->addSql('ALTER TABLE info ADD CONSTRAINT FK_CB8931578092D97F FOREIGN KEY (reviews_id) REFERENCES reviews (id)');
        $this->addSql('CREATE INDEX IDX_CB8931574BD2A4C0 ON info (report_id)');
        $this->addSql('CREATE INDEX IDX_CB8931578092D97F ON info (reviews_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info DROP FOREIGN KEY FK_CB8931574BD2A4C0');
        $this->addSql('ALTER TABLE info DROP FOREIGN KEY FK_CB8931578092D97F');
        $this->addSql('DROP INDEX IDX_CB8931574BD2A4C0 ON info');
        $this->addSql('DROP INDEX IDX_CB8931578092D97F ON info');
        $this->addSql('ALTER TABLE info ADD action VARCHAR(255) NOT NULL, DROP report_id, DROP reviews_id');
    }
}
