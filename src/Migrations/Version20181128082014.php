<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181128082014 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE hds (id INT AUTO_INCREMENT NOT NULL, commune_id INT NOT NULL, nom VARCHAR(255) NOT NULL, pnom VARCHAR(255) NOT NULL, date_naissance DATETIME DEFAULT NULL, niveau_etude VARCHAR(255) NOT NULL, specialite VARCHAR(255) NOT NULL, biographie LONGTEXT NOT NULL, INDEX IDX_7118CDAF131A4F72 (commune_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hds ADD CONSTRAINT FK_7118CDAF131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE hds');
    }
}
