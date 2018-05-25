<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180525085117 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE hotel (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, addressline1 VARCHAR(255) NOT NULL, addressline2 VARCHAR(255) DEFAULT NULL, postcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, pets_allowed TINYINT(1) DEFAULT NULL, openinghours VARCHAR(1024) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, itemreviewed_id INT DEFAULT NULL, reviewbody LONGTEXT NOT NULL, reviewrating INT DEFAULT NULL, authorname VARCHAR(255) DEFAULT NULL, datepublished DATETIME NOT NULL, INDEX IDX_794381C6DBDF9627 (itemreviewed_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6DBDF9627 FOREIGN KEY (itemreviewed_id) REFERENCES hotel (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6DBDF9627');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE review');
    }
}
