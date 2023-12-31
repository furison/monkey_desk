<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231020125710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, date_submitted DATETIME NOT NULL, subject VARCHAR(255) NOT NULL, submitter_id INT NOT NULL, assigned_to INT DEFAULT NULL, priority INT NOT NULL, status VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket_response (id INT AUTO_INCREMENT NOT NULL, ticket_id INT NOT NULL, parent_id INT DEFAULT NULL, subject VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, submitter VARCHAR(255) NOT NULL, INDEX IDX_BB12F77A700047D2 (ticket_id), UNIQUE INDEX UNIQ_BB12F77A727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticket_response ADD CONSTRAINT FK_BB12F77A700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE ticket_response ADD CONSTRAINT FK_BB12F77A727ACA70 FOREIGN KEY (parent_id) REFERENCES ticket_response (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket_response DROP FOREIGN KEY FK_BB12F77A700047D2');
        $this->addSql('ALTER TABLE ticket_response DROP FOREIGN KEY FK_BB12F77A727ACA70');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE ticket_response');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
