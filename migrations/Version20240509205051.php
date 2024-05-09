<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240509205051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info DROP INDEX IDX_CB893157C859AB37, ADD UNIQUE INDEX UNIQ_CB893157C859AB37 (report_analysis_id)');
        $this->addSql('ALTER TABLE info DROP INDEX IDX_CB8931574BD2A4C0, ADD UNIQUE INDEX UNIQ_CB8931574BD2A4C0 (report_id)');
        $this->addSql('ALTER TABLE info DROP FOREIGN KEY FK_CB8931578092D97F');
        $this->addSql('DROP INDEX IDX_CB8931578092D97F ON info');
        $this->addSql('ALTER TABLE info DROP reviews_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info DROP INDEX UNIQ_CB893157C859AB37, ADD INDEX IDX_CB893157C859AB37 (report_analysis_id)');
        $this->addSql('ALTER TABLE info DROP INDEX UNIQ_CB8931574BD2A4C0, ADD INDEX IDX_CB8931574BD2A4C0 (report_id)');
        $this->addSql('ALTER TABLE info ADD reviews_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE info ADD CONSTRAINT FK_CB8931578092D97F FOREIGN KEY (reviews_id) REFERENCES reviews (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_CB8931578092D97F ON info (reviews_id)');
    }
}
