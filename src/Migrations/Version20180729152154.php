<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180729152154 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, header VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE choice (id INT AUTO_INCREMENT NOT NULL, header_id_id INT NOT NULL, name VARCHAR(100) NOT NULL, INDEX IDX_C1AB5A92ECE0E5B0 (header_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gifts (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, img LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, category INT NOT NULL, hobby VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE choice ADD CONSTRAINT FK_C1AB5A92ECE0E5B0 FOREIGN KEY (header_id_id) REFERENCES question (id)');
        $this->addSql('INSERT INTO question (name,header) 
              VALUES ("age","What is your age?"),
               ("sex","What is your sex?"),
               ("location","What is your location?"),
               ("hobby", "what is your hobby")
             ');
        $this->addSql('INSERT INTO choice (name,header_id_id)     
              VALUES  ("<16",1),("16-24",1),
               ("24-35", 1),
               ("35+",1),
               ("male",2),
               ("famele",2),
               ("Lviv",3),
               ("Kyiv",3),
               ("Odessa",3),
               ("Cinema",4),
               ("Trip",4),
               ("Music",4),
               ("Sport",4),
               ("Art",4)
                ');
    }


    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE choice DROP FOREIGN KEY FK_C1AB5A92ECE0E5B0');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE choice');
        $this->addSql('DROP TABLE gifts');
        $this->addSql('DROP TABLE category');
    }
}
