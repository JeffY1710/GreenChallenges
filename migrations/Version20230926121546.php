<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230926121546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE challenge (id INT AUTO_INCREMENT NOT NULL, user_challenge_id INT NOT NULL, title VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, sub_category VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, deadline INT NOT NULL, points INT NOT NULL, INDEX IDX_D7098951186E66C4 (user_challenge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, birthday DATE NOT NULL, password VARCHAR(255) NOT NULL, score INT NOT NULL, challenges_realised INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_challenge (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, statut VARCHAR(100) NOT NULL, date_fin DATE NOT NULL, date_fin_obligatoire DATE NOT NULL, INDEX IDX_D7E904B5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D7098951186E66C4 FOREIGN KEY (user_challenge_id) REFERENCES user_challenge (id)');
        $this->addSql('ALTER TABLE user_challenge ADD CONSTRAINT FK_D7E904B5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE challenge DROP FOREIGN KEY FK_D7098951186E66C4');
        $this->addSql('ALTER TABLE user_challenge DROP FOREIGN KEY FK_D7E904B5A76ED395');
        $this->addSql('DROP TABLE challenge');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_challenge');
    }
}
