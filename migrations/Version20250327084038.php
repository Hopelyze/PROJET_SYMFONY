<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250327084038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE flowers (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, wording VARCHAR(200) NOT NULL, price DOUBLE PRECISION NOT NULL, quantity_stock INTEGER DEFAULT NULL, image VARCHAR(255) DEFAULT NULL)');
        $this->addSql('DROP TABLE fleurs');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fleurs (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle VARCHAR(200) NOT NULL COLLATE "BINARY", prix DOUBLE PRECISION NOT NULL, quantite_stock INTEGER DEFAULT NULL)');
        $this->addSql('DROP TABLE flowers');
    }
}
