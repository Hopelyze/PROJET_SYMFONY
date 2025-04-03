<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250403155751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE l3_cart (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, flower_id INTEGER NOT NULL, quantity INTEGER NOT NULL, CONSTRAINT FK_C330835DA76ED395 FOREIGN KEY (user_id) REFERENCES l3_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C330835D2C09D409 FOREIGN KEY (flower_id) REFERENCES l3_flowers (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_C330835DA76ED395 ON l3_cart (user_id)');
        $this->addSql('CREATE INDEX IDX_C330835D2C09D409 ON l3_cart (flower_id)');
        $this->addSql('CREATE TABLE l3_country (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(10) NOT NULL)');
        $this->addSql('CREATE TABLE l3_flowers (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, wording VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, quantity_stock INTEGER NOT NULL, image VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE l3_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, forename VARCHAR(255) NOT NULL, birthday DATE DEFAULT NULL --(DC2Type:date_immutable)
        , admin BOOLEAN DEFAULT 0 NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_LOGIN ON l3_user (login)');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE flowers');
        $this->addSql('DROP TABLE user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, flower_id INTEGER NOT NULL, quantity INTEGER NOT NULL, CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BA388B72C09D409 FOREIGN KEY (flower_id) REFERENCES flowers (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_BA388B7A76ED395 ON cart (user_id)');
        $this->addSql('CREATE INDEX IDX_BA388B72C09D409 ON cart (flower_id)');
        $this->addSql('CREATE TABLE country (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE "BINARY", code VARCHAR(10) NOT NULL COLLATE "BINARY")');
        $this->addSql('CREATE TABLE flowers (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, wording VARCHAR(255) NOT NULL COLLATE "BINARY", price DOUBLE PRECISION NOT NULL, quantity_stock INTEGER NOT NULL, image VARCHAR(255) DEFAULT NULL COLLATE "BINARY")');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, login VARCHAR(180) NOT NULL COLLATE "BINARY", roles CLOB NOT NULL COLLATE "BINARY" --(DC2Type:json)
        , password VARCHAR(255) NOT NULL COLLATE "BINARY", name VARCHAR(255) NOT NULL COLLATE "BINARY", forename VARCHAR(255) NOT NULL COLLATE "BINARY", birthday DATE DEFAULT NULL --(DC2Type:date_immutable)
        , admin BOOLEAN DEFAULT 0 NOT NULL, country VARCHAR(255) DEFAULT NULL COLLATE "BINARY")');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_LOGIN ON user (login)');
        $this->addSql('DROP TABLE l3_cart');
        $this->addSql('DROP TABLE l3_country');
        $this->addSql('DROP TABLE l3_flowers');
        $this->addSql('DROP TABLE l3_user');
    }
}
