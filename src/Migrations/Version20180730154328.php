<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180730154328 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A92ECE0E5B0');
        $this->addSql('CREATE TABLE gift (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, hobby_id INT DEFAULT NULL, category_id INT NOT NULL, name VARCHAR(100) NOT NULL, price INT NOT NULL, link LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, img VARCHAR(255) NOT NULL, INDEX IDX_A47C990D64D218E (location_id), INDEX IDX_A47C990D322B2123 (hobby_id), INDEX IDX_A47C990D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gift ADD CONSTRAINT FK_A47C990D64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE gift ADD CONSTRAINT FK_A47C990D322B2123 FOREIGN KEY (hobby_id) REFERENCES hobby (id)');
        $this->addSql('ALTER TABLE gift ADD CONSTRAINT FK_A47C990D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('DROP TABLE choice');
        $this->addSql('DROP TABLE gifts');
        $this->addSql('DROP TABLE question');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE choice (id INT AUTO_INCREMENT NOT NULL, header_id_id INT NOT NULL, name VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_C1AB5A92ECE0E5B0 (header_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gifts (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, link VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, img VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, category VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, hobby VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, location VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, header VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A92ECE0E5B0 FOREIGN KEY (header_id_id) REFERENCES question (id)');
        $this->addSql('DROP TABLE gift');
    }
}
