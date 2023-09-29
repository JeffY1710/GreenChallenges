<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230929094816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE challenge DROP FOREIGN KEY FK_D7098951186E66C4');
        $this->addSql('DROP INDEX IDX_D7098951186E66C4 ON challenge');
        $this->addSql('ALTER TABLE challenge DROP user_challenge_id');
        $this->addSql('ALTER TABLE user_challenge ADD challenge_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL, CHANGE date_fin date_fin DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE user_challenge ADD CONSTRAINT FK_D7E904B598A21AC6 FOREIGN KEY (challenge_id) REFERENCES challenge (id)');
        $this->addSql('CREATE INDEX IDX_D7E904B598A21AC6 ON user_challenge (challenge_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE challenge ADD user_challenge_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D7098951186E66C4 FOREIGN KEY (user_challenge_id) REFERENCES user_challenge (id)');
        $this->addSql('CREATE INDEX IDX_D7098951186E66C4 ON challenge (user_challenge_id)');
        $this->addSql('ALTER TABLE user_challenge DROP FOREIGN KEY FK_D7E904B598A21AC6');
        $this->addSql('DROP INDEX IDX_D7E904B598A21AC6 ON user_challenge');
        $this->addSql('ALTER TABLE user_challenge DROP challenge_id, CHANGE user_id user_id INT DEFAULT NULL, CHANGE date_fin date_fin DATE NOT NULL');
    }
}
