<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230927123948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE challenge CHANGE user_challenge_id user_challenge_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE score score INT DEFAULT 0 NOT NULL, CHANGE challenges_realised challenges_realised INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE user_challenge CHANGE user_id user_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE challenge CHANGE user_challenge_id user_challenge_id INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE score score INT NOT NULL, CHANGE challenges_realised challenges_realised INT NOT NULL');
        $this->addSql('ALTER TABLE user_challenge CHANGE user_id user_id INT NOT NULL');
    }
}
