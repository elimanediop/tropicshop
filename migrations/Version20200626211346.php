<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200626211346 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE store (id INT AUTO_INCREMENT NOT NULL, manager_id INT NOT NULL, adresse_id INT NOT NULL, tva_id INT NOT NULL, nom VARCHAR(255) NOT NULL, mail VARCHAR(255) DEFAULT NULL, tel INT DEFAULT NULL, UNIQUE INDEX UNIQ_FF575877783E3463 (manager_id), UNIQUE INDEX UNIQ_FF5758774DE7DC5C (adresse_id), UNIQUE INDEX UNIQ_FF5758774D79775F (tva_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tva (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(9) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT FK_FF575877783E3463 FOREIGN KEY (manager_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT FK_FF5758774DE7DC5C FOREIGN KEY (adresse_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT FK_FF5758774D79775F FOREIGN KEY (tva_id) REFERENCES tva (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE store DROP FOREIGN KEY FK_FF5758774D79775F');
        $this->addSql('DROP TABLE store');
        $this->addSql('DROP TABLE tva');
    }
}
