<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250402162224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, flower_id INTEGER NOT NULL, product_id INTEGER NOT NULL, quantity INTEGER NOT NULL, CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BA388B72C09D409 FOREIGN KEY (flower_id) REFERENCES flowers (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BA388B74584665A FOREIGN KEY (product_id) REFERENCES flowers (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_BA388B7A76ED395 ON cart (user_id)');
        $this->addSql('CREATE INDEX IDX_BA388B72C09D409 ON cart (flower_id)');
        $this->addSql('CREATE INDEX IDX_BA388B74584665A ON cart (product_id)');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, name VARCHAR(200) NOT NULL, forename VARCHAR(200) NOT NULL, birth DATE NOT NULL, admin BOOLEAN NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_LOGIN ON "user" (login)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__flowers AS SELECT id, wording, price, quantity_stock, image FROM flowers');
        $this->addSql('DROP TABLE flowers');
        $this->addSql('CREATE TABLE flowers (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, wording VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, quantity_stock INTEGER NOT NULL, image VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO flowers (id, wording, price, quantity_stock, image) SELECT id, wording, price, quantity_stock, image FROM __temp__flowers');
        $this->addSql('DROP TABLE __temp__flowers');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('CREATE TEMPORARY TABLE __temp__flowers AS SELECT id, wording, price, quantity_stock, image FROM flowers');
        $this->addSql('DROP TABLE flowers');
        $this->addSql('CREATE TABLE flowers (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, wording VARCHAR(200) NOT NULL, price DOUBLE PRECISION NOT NULL, quantity_stock INTEGER DEFAULT NULL, image VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO flowers (id, wording, price, quantity_stock, image) SELECT id, wording, price, quantity_stock, image FROM __temp__flowers');
        $this->addSql('DROP TABLE __temp__flowers');
    }
}
