<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190709135148 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE flight (id INT AUTO_INCREMENT NOT NULL, pilot_id INT NOT NULL, plane_id INT NOT NULL, flightts DATETIME NOT NULL, INDEX IDX_C257E60ECE55439B (pilot_id), INDEX IDX_C257E60EF53666A8 (plane_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60ECE55439B FOREIGN KEY (pilot_id) REFERENCES pilot (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60EF53666A8 FOREIGN KEY (plane_id) REFERENCES plane (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE flight');
    }
}
