<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220314105800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sto_time_project (id INT AUTO_INCREMENT NOT NULL, sto_employee_id INT NOT NULL, sto_project_id INT NOT NULL, day INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_62679D0DB3D905CA (sto_employee_id), INDEX IDX_62679D0D799F543A (sto_project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sto_time_project ADD CONSTRAINT FK_62679D0DB3D905CA FOREIGN KEY (sto_employee_id) REFERENCES sto_employees (id)');
        $this->addSql('ALTER TABLE sto_time_project ADD CONSTRAINT FK_62679D0D799F543A FOREIGN KEY (sto_project_id) REFERENCES sto_project (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sto_time_project');
    }
}
