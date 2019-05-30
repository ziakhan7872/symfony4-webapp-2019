<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190528155840 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article CHANGE vote_up vote_up VARCHAR(255) NOT NULL, CHANGE vote_down vote_down VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD status VARCHAR(15) DEFAULT NULL, ADD api_token VARCHAR(255) DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, CHANGE roles roles Text NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article CHANGE vote_up vote_up INT NOT NULL, CHANGE vote_down vote_down INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP status, DROP api_token, DROP created_at, DROP updated_at, CHANGE roles roles TEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
