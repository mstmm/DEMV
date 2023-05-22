<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516211500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gesellschaft (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE makler (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vermittlernummer (id INT AUTO_INCREMENT NOT NULL, gesellschaft_id INT NOT NULL, makler_id INT NOT NULL, vermittlernummer VARCHAR(255) NOT NULL, INDEX IDX_222C11A5A7DC6C38 (gesellschaft_id), INDEX IDX_222C11A5A807894E (makler_id), UNIQUE INDEX vermittlernummer_unique_idx (gesellschaft_id, makler_id, vermittlernummer), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vermittlernummer ADD CONSTRAINT FK_222C11A5A7DC6C38 FOREIGN KEY (gesellschaft_id) REFERENCES gesellschaft (id)');
        $this->addSql('ALTER TABLE vermittlernummer ADD CONSTRAINT FK_222C11A5A807894E FOREIGN KEY (makler_id) REFERENCES makler (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vermittlernummer DROP FOREIGN KEY FK_222C11A5A7DC6C38');
        $this->addSql('ALTER TABLE vermittlernummer DROP FOREIGN KEY FK_222C11A5A807894E');
        $this->addSql('DROP TABLE gesellschaft');
        $this->addSql('DROP TABLE makler');
        $this->addSql('DROP TABLE vermittlernummer');
    }
}
