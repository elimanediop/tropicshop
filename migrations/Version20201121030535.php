<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201121030535 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bon_livraison (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, date_livraison VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, codepostal INT NOT NULL, ville VARCHAR(255) NOT NULL, type_livraison VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_31A531A482EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_6EEAA67D19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bon_livraison ADD CONSTRAINT FK_31A531A482EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bon_livraison DROP FOREIGN KEY FK_31A531A482EA2E54');
        $this->addSql('DROP TABLE bon_livraison');
        $this->addSql('DROP TABLE commande');
    }
}
