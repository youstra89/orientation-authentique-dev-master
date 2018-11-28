<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181128121435 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mosquee (id INT AUTO_INCREMENT NOT NULL, commune_id INT NOT NULL, imam_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, quartier VARCHAR(255) NOT NULL, nom_imam VARCHAR(255) DEFAULT NULL, numero_imam VARCHAR(255) DEFAULT NULL, responsable VARCHAR(255) DEFAULT NULL, numero_responsable VARCHAR(255) DEFAULT NULL, djoumoua TINYINT(1) NOT NULL, annee_construction VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_9436B2BC131A4F72 (commune_id), UNIQUE INDEX UNIQ_9436B2BCC336A7CD (imam_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mosquee ADD CONSTRAINT FK_9436B2BC131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE mosquee ADD CONSTRAINT FK_9436B2BCC336A7CD FOREIGN KEY (imam_id) REFERENCES hds (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE mosquee');
    }
}
