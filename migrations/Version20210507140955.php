<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210507140955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE engine_model (engine_id INT NOT NULL, model_id INT NOT NULL, INDEX IDX_FAFDA692E78C9C0A (engine_id), INDEX IDX_FAFDA6927975B7E7 (model_id), PRIMARY KEY(engine_id, model_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE engine_model ADD CONSTRAINT FK_FAFDA692E78C9C0A FOREIGN KEY (engine_id) REFERENCES engine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE engine_model ADD CONSTRAINT FK_FAFDA6927975B7E7 FOREIGN KEY (model_id) REFERENCES model (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE engine_model');
    }
}
