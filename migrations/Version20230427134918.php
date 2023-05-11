<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230427134918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status_order VARCHAR(255) NOT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_details (id INT AUTO_INCREMENT NOT NULL, command_id INT NOT NULL, book_id INT NOT NULL, quantity INT NOT NULL, price NUMERIC(10, 2) NOT NULL, total_price NUMERIC(10, 2) NOT NULL, INDEX IDX_845CA2C133E1689A (command_id), INDEX IDX_845CA2C116A2B381 (book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, lastname VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, birth_date DATE NOT NULL, status_user VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_details ADD CONSTRAINT FK_845CA2C133E1689A FOREIGN KEY (command_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_details ADD CONSTRAINT FK_845CA2C116A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE book ADD category_id INT NOT NULL, DROP category');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A33112469DE2 ON book (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33112469DE2');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE order_details DROP FOREIGN KEY FK_845CA2C133E1689A');
        $this->addSql('ALTER TABLE order_details DROP FOREIGN KEY FK_845CA2C116A2B381');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_details');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_CBE5A33112469DE2 ON book');
        $this->addSql('ALTER TABLE book ADD category VARCHAR(255) NOT NULL, DROP category_id');
    }
}
