<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200630182106 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2787998E');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, cli_nom VARCHAR(255) NOT NULL, cli_prenom VARCHAR(255) NOT NULL, cli_mail VARCHAR(255) NOT NULL, cli_tel VARCHAR(255) DEFAULT NULL, cli_mdp VARCHAR(255) NOT NULL, cli_adresse VARCHAR(255) DEFAULT NULL, role VARCHAR(255) NOT NULL, codepostal INT NOT NULL, ville VARCHAR(255) NOT NULL, nommagasin VARCHAR(255) DEFAULT NULL, tva VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE origine');
        $this->addSql('DROP INDEX UNIQ_29A5EC2787998E ON produit');
        $this->addSql('ALTER TABLE produit ADD origine VARCHAR(255) DEFAULT NULL, DROP origine_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, suffixe VARCHAR(3) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, rue VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, code_postal INT NOT NULL, ville VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, complement VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, cli_adresse_id INT NOT NULL, cli_nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cli_prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cli_mail VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cli_tel VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, cli_mdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_C7440455459E7BC1 (cli_adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE origine (id INT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, alpha_2 VARCHAR(2) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, alpha_3 VARCHAR(3) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE store (id INT AUTO_INCREMENT NOT NULL, manager_id INT DEFAULT NULL, adresse_id INT NOT NULL, tva_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mail VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, tel VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_FF575877783E3463 (manager_id), UNIQUE INDEX UNIQ_FF5758774DE7DC5C (adresse_id), UNIQUE INDEX UNIQ_FF5758774D79775F (tva_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tva (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(9) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455459E7BC1 FOREIGN KEY (cli_adresse_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT FK_FF5758774D79775F FOREIGN KEY (tva_id) REFERENCES tva (id)');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT FK_FF5758774DE7DC5C FOREIGN KEY (adresse_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT FK_FF575877783E3463 FOREIGN KEY (manager_id) REFERENCES client (id)');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE produit ADD origine_id INT DEFAULT NULL, DROP origine');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2787998E FOREIGN KEY (origine_id) REFERENCES origine (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29A5EC2787998E ON produit (origine_id)');
    }
}
