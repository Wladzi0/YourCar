<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211007082124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE part (id INT AUTO_INCREMENT NOT NULL, car_id INT DEFAULT NULL, engine_id INT DEFAULT NULL, catalog_number VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_490F70C6C3C6F69F (car_id), INDEX IDX_490F70C6E78C9C0A (engine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE part ADD CONSTRAINT FK_490F70C6C3C6F69F FOREIGN KEY (car_id) REFERENCES sub_model (id)');
        $this->addSql('ALTER TABLE part ADD CONSTRAINT FK_490F70C6E78C9C0A FOREIGN KEY (engine_id) REFERENCES engine (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE part');
    }
}
