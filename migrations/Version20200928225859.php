<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200928225859 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE page_eleve (id INT AUTO_INCREMENT NOT NULL, user_eleve_id INT NOT NULL, auteur VARCHAR(255) NOT NULL, valide TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_8A20FA21EAE123B2 (user_eleve_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_externe (id INT AUTO_INCREMENT NOT NULL, redirection VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_nathalie (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, lien_azza VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_eleve (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, INDEX IDX_E63FEAFA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE page_eleve ADD CONSTRAINT FK_8A20FA21EAE123B2 FOREIGN KEY (user_eleve_id) REFERENCES user_eleve (id)');
        $this->addSql('ALTER TABLE user_eleve ADD CONSTRAINT FK_E63FEAFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_eleve DROP FOREIGN KEY FK_E63FEAFA76ED395');
        $this->addSql('ALTER TABLE page_eleve DROP FOREIGN KEY FK_8A20FA21EAE123B2');
        $this->addSql('DROP TABLE page_eleve');
        $this->addSql('DROP TABLE page_externe');
        $this->addSql('DROP TABLE page_nathalie');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_eleve');
    }
}
