<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201014215942 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit_store DROP INDEX UNIQ_CFCB3FE3B092A811, ADD INDEX IDX_CFCB3FE3B092A811 (store_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit_store DROP INDEX IDX_CFCB3FE3B092A811, ADD UNIQUE INDEX UNIQ_CFCB3FE3B092A811 (store_id)');
    }
}
