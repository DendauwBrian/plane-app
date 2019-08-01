<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190801084009 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE flight (id INT AUTO_INCREMENT NOT NULL, pilot_id INT NOT NULL, plane_id INT NOT NULL, user_id INT NOT NULL, flightts DATETIME NOT NULL, INDEX IDX_C257E60ECE55439B (pilot_id), INDEX IDX_C257E60EF53666A8 (plane_id), INDEX IDX_C257E60EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pilot (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, rank VARCHAR(255) NOT NULL, age INT NOT NULL, retired TINYINT(1) NOT NULL, INDEX IDX_8D1E5F52A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plane (id INT AUTO_INCREMENT NOT NULL, model VARCHAR(255) NOT NULL, manufacturer VARCHAR(255) NOT NULL, engines VARCHAR(255) DEFAULT NULL, buildday DATETIME NOT NULL, lastflight DATETIME DEFAULT NULL, decommissioned TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60ECE55439B FOREIGN KEY (pilot_id) REFERENCES pilot (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60EF53666A8 FOREIGN KEY (plane_id) REFERENCES plane (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pilot ADD CONSTRAINT FK_8D1E5F52A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60ECE55439B');
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60EF53666A8');
        $this->addSql('ALTER TABLE flight DROP FOREIGN KEY FK_C257E60EA76ED395');
        $this->addSql('ALTER TABLE pilot DROP FOREIGN KEY FK_8D1E5F52A76ED395');
        $this->addSql('DROP TABLE flight');
        $this->addSql('DROP TABLE pilot');
        $this->addSql('DROP TABLE plane');
        $this->addSql('DROP TABLE user');
    }
}
