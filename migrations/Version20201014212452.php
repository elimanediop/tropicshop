<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201014212452 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27B092A811');
        $this->addSql('DROP INDEX IDX_29A5EC27B092A811 ON produit');
        $this->addSql('ALTER TABLE produit DROP store_id');
        $this->addSql('ALTER TABLE produit_store ADD store_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit_store ADD CONSTRAINT FK_CFCB3FE3B092A811 FOREIGN KEY (store_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFCB3FE3B092A811 ON produit_store (store_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit ADD store_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27B092A811 FOREIGN KEY (store_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_29A5EC27B092A811 ON produit (store_id)');
        $this->addSql('ALTER TABLE produit_store DROP FOREIGN KEY FK_CFCB3FE3B092A811');
        $this->addSql('DROP INDEX UNIQ_CFCB3FE3B092A811 ON produit_store');
        $this->addSql('ALTER TABLE produit_store DROP store_id');
    }
}
