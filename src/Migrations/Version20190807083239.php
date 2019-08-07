<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190807083239 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rank (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pilot ADD rank_id INT NOT NULL, DROP rank');
        $this->addSql('ALTER TABLE pilot ADD CONSTRAINT FK_8D1E5F527616678F FOREIGN KEY (rank_id) REFERENCES rank (id)');
        $this->addSql('CREATE INDEX IDX_8D1E5F527616678F ON pilot (rank_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pilot DROP FOREIGN KEY FK_8D1E5F527616678F');
        $this->addSql('DROP TABLE rank');
        $this->addSql('DROP INDEX IDX_8D1E5F527616678F ON pilot');
        $this->addSql('ALTER TABLE pilot ADD rank VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP rank_id');
    }
}
