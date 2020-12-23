<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218075311 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre_equipe (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, civilite VARCHAR(10) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, metier VARCHAR(50) NOT NULL, specialite VARCHAR(50) NOT NULL, description_metier VARCHAR(255) NOT NULL, experience VARCHAR(255) NOT NULL, formation VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_BE402FAC3DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE membre_equipe ADD CONSTRAINT FK_BE402FAC3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre_equipe DROP FOREIGN KEY FK_BE402FAC3DA5256D');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE membre_equipe');
    }
}
