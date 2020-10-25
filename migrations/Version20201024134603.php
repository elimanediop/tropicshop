<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201024134603 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP INDEX UNIQ_29A5EC2721AE9982, ADD INDEX IDX_29A5EC2721AE9982 (typevente_id)');
        $this->addSql('ALTER TABLE produit DROP typevente');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP INDEX IDX_29A5EC2721AE9982, ADD UNIQUE INDEX UNIQ_29A5EC2721AE9982 (typevente_id)');
        $this->addSql('ALTER TABLE produit ADD typevente VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
