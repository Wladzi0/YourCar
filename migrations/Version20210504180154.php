<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504180154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, make VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, year INT NOT NULL, engine VARCHAR(255) NOT NULL, transmition VARCHAR(255) NOT NULL, engine_power VARCHAR(255) NOT NULL, type_size VARCHAR(255) NOT NULL, fuel_economy VARCHAR(255) NOT NULL, for_what VARCHAR(255) NOT NULL, size VARCHAR(255) NOT NULL, fuel_type VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, body_type VARCHAR(255) NOT NULL, boot_capacity VARCHAR(255) NOT NULL, rareness VARCHAR(255) NOT NULL, engine_life VARCHAR(255) NOT NULL, failure_rate VARCHAR(255) NOT NULL, tuning VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE car');
    }
}
