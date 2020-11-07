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
        $this->addSql('DROP TABLE produit_store_origine');
        $this->addSql('ALTER TABLE produit_store ADD origine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit_store ADD CONSTRAINT FK_CFCB3FE387998E FOREIGN KEY (origine_id) REFERENCES origine (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit_store_origine (produit_store_id INT NOT NULL, origine_id INT NOT NULL, INDEX IDX_225D315687998E (origine_id), INDEX IDX_225D3156998D9A02 (produit_store_id), PRIMARY KEY(produit_store_id, origine_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE produit_store_origine ADD CONSTRAINT FK_225D315687998E FOREIGN KEY (origine_id) REFERENCES origine (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_store_origine ADD CONSTRAINT FK_225D3156998D9A02 FOREIGN KEY (produit_store_id) REFERENCES produit_store (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_store DROP FOREIGN KEY FK_CFCB3FE387998E');
        $this->addSql('ALTER TABLE produit_store DROP origine_id');
    }
}
