<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507213038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info ADD report_analysis_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE info ADD CONSTRAINT FK_CB893157C859AB37 FOREIGN KEY (report_analysis_id) REFERENCES report_analysis (id)');
        $this->addSql('CREATE INDEX IDX_CB893157C859AB37 ON info (report_analysis_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info DROP FOREIGN KEY FK_CB893157C859AB37');
        $this->addSql('DROP INDEX IDX_CB893157C859AB37 ON info');
        $this->addSql('ALTER TABLE info DROP report_analysis_id');
    }
}
