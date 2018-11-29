<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181129224042 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hds CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE mosquee CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE cours CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE discipline CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE ecole CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE livre CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE region CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE ville CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE commune CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commune CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE cours CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE discipline CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE ecole CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE hds CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE livre CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE mosquee CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE region CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE ville CHANGE updated_at updated_at DATETIME NOT NULL');
    }
}
