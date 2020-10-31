<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201031102215 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit_store DROP INDEX UNIQ_CFCB3FE3F347EFB, ADD INDEX IDX_CFCB3FE3F347EFB (produit_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit_store DROP INDEX IDX_CFCB3FE3F347EFB, ADD UNIQUE INDEX UNIQ_CFCB3FE3F347EFB (produit_id)');
    }
}
