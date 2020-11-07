<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201105172833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit_store ADD origine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit_store ADD CONSTRAINT FK_CFCB3FE387998E FOREIGN KEY (origine_id) REFERENCES origine (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit_store DROP FOREIGN KEY FK_CFCB3FE387998E');
        $this->addSql('ALTER TABLE produit_store DROP origine_id');
    }
}
