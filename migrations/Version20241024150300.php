<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024150300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_profile AS SELECT id, name, bio, web_site_url, twitter_username, company, location, date_of_birth FROM user_profile');
        $this->addSql('DROP TABLE user_profile');
        $this->addSql('CREATE TABLE user_profile (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, name VARCHAR(255) DEFAULT NULL, bio VARCHAR(255) DEFAULT NULL, web_site_url VARCHAR(255) DEFAULT NULL, twitter_username VARCHAR(255) DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, date_of_birth DATE DEFAULT NULL --(DC2Type:date_immutable)
        , CONSTRAINT FK_D95AB405A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_profile (id, name, bio, web_site_url, twitter_username, company, location, date_of_birth) SELECT id, name, bio, web_site_url, twitter_username, company, location, date_of_birth FROM __temp__user_profile');
        $this->addSql('DROP TABLE __temp__user_profile');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D95AB405A76ED395 ON user_profile (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_profile AS SELECT id, name, bio, web_site_url, twitter_username, company, location, date_of_birth FROM user_profile');
        $this->addSql('DROP TABLE user_profile');
        $this->addSql('CREATE TABLE user_profile (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, bio VARCHAR(255) DEFAULT NULL, web_site_url VARCHAR(255) DEFAULT NULL, twitter_username VARCHAR(255) DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, date_of_birth DATE DEFAULT NULL --(DC2Type:date_immutable)
        )');
        $this->addSql('INSERT INTO user_profile (id, name, bio, web_site_url, twitter_username, company, location, date_of_birth) SELECT id, name, bio, web_site_url, twitter_username, company, location, date_of_birth FROM __temp__user_profile');
        $this->addSql('DROP TABLE __temp__user_profile');
    }
}
