<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190612081414 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE reader (id INT AUTO_INCREMENT NOT NULL, tea_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, age INT DEFAULT NULL, INDEX IDX_CC3F893C6A399A0D (tea_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reader_book (reader_id INT NOT NULL, book_id INT NOT NULL, INDEX IDX_2A3845F31717D737 (reader_id), INDEX IDX_2A3845F316A2B381 (book_id), PRIMARY KEY(reader_id, book_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, title VARCHAR(100) NOT NULL, INDEX IDX_CBE5A331F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tea (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, origin VARCHAR(100) DEFAULT NULL, color VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reader ADD CONSTRAINT FK_CC3F893C6A399A0D FOREIGN KEY (tea_id) REFERENCES tea (id)');
        $this->addSql('ALTER TABLE reader_book ADD CONSTRAINT FK_2A3845F31717D737 FOREIGN KEY (reader_id) REFERENCES reader (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reader_book ADD CONSTRAINT FK_2A3845F316A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reader_book DROP FOREIGN KEY FK_2A3845F31717D737');
        $this->addSql('ALTER TABLE reader_book DROP FOREIGN KEY FK_2A3845F316A2B381');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331F675F31B');
        $this->addSql('ALTER TABLE reader DROP FOREIGN KEY FK_CC3F893C6A399A0D');
        $this->addSql('DROP TABLE reader');
        $this->addSql('DROP TABLE reader_book');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE tea');
    }
}
