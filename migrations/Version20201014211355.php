<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201014211355 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_store ADD origine_id INT DEFAULT NULL, ADD typevente VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE product_store ADD CONSTRAINT FK_CFCB3FE387998E FOREIGN KEY (origine_id) REFERENCES origine (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFCB3FE387998E ON product_store (origine_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_store DROP FOREIGN KEY FK_CFCB3FE387998E');
        $this->addSql('DROP INDEX UNIQ_CFCB3FE387998E ON product_store');
        $this->addSql('ALTER TABLE product_store DROP origine_id, DROP typevente');
    }
}
