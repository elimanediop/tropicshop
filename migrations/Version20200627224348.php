<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200627224348 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE origine (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, origine_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_29A5EC2787998E (origine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_produit (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('INSERT INTO type_produit(id, libelle) VALUES(1,"Fruit"),(3, "Légume"),(4, "Condiments et Epices"), (2, "Cosmétiques"), (5, "Autres")');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2787998E FOREIGN KEY (origine_id) REFERENCES origine (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2787998E');
        $this->addSql('DROP TABLE origine');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE type_produit');
    }
}
