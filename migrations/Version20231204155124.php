<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204155124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt ADD emprunteurs_id INT NOT NULL');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D75F3C9C2A FOREIGN KEY (emprunteurs_id) REFERENCES emprunteur (id)');
        $this->addSql('CREATE INDEX IDX_364071D75F3C9C2A ON emprunt (emprunteurs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D75F3C9C2A');
        $this->addSql('DROP INDEX IDX_364071D75F3C9C2A ON emprunt');
        $this->addSql('ALTER TABLE emprunt DROP emprunteurs_id');
    }
}
