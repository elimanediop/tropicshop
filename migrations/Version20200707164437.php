<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200707164437 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit ADD typeproduit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27F66E9EF6 FOREIGN KEY (typeproduit_id) REFERENCES type_produit (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27F66E9EF6 ON produit (typeproduit_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27F66E9EF6');
        $this->addSql('DROP INDEX IDX_29A5EC27F66E9EF6 ON produit');
        $this->addSql('ALTER TABLE produit DROP typeproduit_id');
    }
}
