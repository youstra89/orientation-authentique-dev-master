<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181128221825 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // $this->addSql('CREATE TABLE discipline (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE livre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE livre_discipline (livre_id INT NOT NULL, discipline_id INT NOT NULL, INDEX IDX_4312C21937D925CB (livre_id), INDEX IDX_4312C219A5522701 (discipline_id), PRIMARY KEY(livre_id, discipline_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE livre_discipline ADD CONSTRAINT FK_4312C21937D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE livre_discipline ADD CONSTRAINT FK_4312C219A5522701 FOREIGN KEY (discipline_id) REFERENCES discipline (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE livre_discipline DROP FOREIGN KEY FK_4312C219A5522701');
        $this->addSql('ALTER TABLE livre_discipline DROP FOREIGN KEY FK_4312C21937D925CB');
        $this->addSql('DROP TABLE discipline');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE livre_discipline');
    }
}
