<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200628002015 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit ADD origine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2787998E FOREIGN KEY (origine_id) REFERENCES origine (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29A5EC2787998E ON produit (origine_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2787998E');
        $this->addSql('DROP INDEX UNIQ_29A5EC2787998E ON produit');
        $this->addSql('ALTER TABLE produit DROP origine_id');
    }
}
