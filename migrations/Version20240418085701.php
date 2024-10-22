<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240418085701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercices (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(300) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, firstname VARCHAR(150) NOT NULL, lastname VARCHAR(150) NOT NULL, birthdate DATE NOT NULL, goal VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workout_exercices (id INT AUTO_INCREMENT NOT NULL, exercice_id INT DEFAULT NULL, workout_id INT NOT NULL, number_of_repetitions INT NOT NULL, duration DOUBLE PRECISION NOT NULL, INDEX IDX_315D8DB589D40298 (exercice_id), INDEX IDX_315D8DB5A6CCCFC9 (workout_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workouts (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date DATETIME NOT NULL, notes VARCHAR(255) NOT NULL, type_of_workout VARCHAR(255) NOT NULL, INDEX IDX_A56140E0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE workout_exercices ADD CONSTRAINT FK_315D8DB589D40298 FOREIGN KEY (exercice_id) REFERENCES exercices (id)');
        $this->addSql('ALTER TABLE workout_exercices ADD CONSTRAINT FK_315D8DB5A6CCCFC9 FOREIGN KEY (workout_id) REFERENCES workouts (id)');
        $this->addSql('ALTER TABLE workouts ADD CONSTRAINT FK_A56140E0A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE workout_exercices DROP FOREIGN KEY FK_315D8DB589D40298');
        $this->addSql('ALTER TABLE workout_exercices DROP FOREIGN KEY FK_315D8DB5A6CCCFC9');
        $this->addSql('ALTER TABLE workouts DROP FOREIGN KEY FK_A56140E0A76ED395');
        $this->addSql('DROP TABLE exercices');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE workout_exercices');
        $this->addSql('DROP TABLE workouts');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
