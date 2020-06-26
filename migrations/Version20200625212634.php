<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200625212634 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, suffixe VARCHAR(3) DEFAULT NULL, rue VARCHAR(255) NOT NULL, code_postal INT NOT NULL, ville VARCHAR(255) NOT NULL, complement VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, cli_adresse_id INT NOT NULL, cli_nom VARCHAR(255) NOT NULL, cli_prenom VARCHAR(255) NOT NULL, cli_mail VARCHAR(255) NOT NULL, cli_tel INT DEFAULT NULL, cli_mdp VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C7440455459E7BC1 (cli_adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455459E7BC1 FOREIGN KEY (cli_adresse_id) REFERENCES address (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455459E7BC1');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE client');
    }
}
