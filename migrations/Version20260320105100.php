<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260320105100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fromage_enseigne (fromage_id INT NOT NULL, enseigne_id INT NOT NULL, INDEX IDX_B9EC0F5C7FCE0491 (fromage_id), INDEX IDX_B9EC0F5C6C2A0A71 (enseigne_id), PRIMARY KEY (fromage_id, enseigne_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE fromage_accord (fromage_id INT NOT NULL, accord_id INT NOT NULL, INDEX IDX_D5CF53D47FCE0491 (fromage_id), INDEX IDX_D5CF53D41EDF023F (accord_id), PRIMARY KEY (fromage_id, accord_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE fromage_enseigne ADD CONSTRAINT FK_B9EC0F5C7FCE0491 FOREIGN KEY (fromage_id) REFERENCES fromage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fromage_enseigne ADD CONSTRAINT FK_B9EC0F5C6C2A0A71 FOREIGN KEY (enseigne_id) REFERENCES enseigne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fromage_accord ADD CONSTRAINT FK_D5CF53D47FCE0491 FOREIGN KEY (fromage_id) REFERENCES fromage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fromage_accord ADD CONSTRAINT FK_D5CF53D41EDF023F FOREIGN KEY (accord_id) REFERENCES accord (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fromage ADD user_id INT NOT NULL, ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE fromage ADD CONSTRAINT FK_BFBF0C89A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE fromage ADD CONSTRAINT FK_BFBF0C89BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_BFBF0C89A76ED395 ON fromage (user_id)');
        $this->addSql('CREATE INDEX IDX_BFBF0C89BCF5E72D ON fromage (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fromage_enseigne DROP FOREIGN KEY FK_B9EC0F5C7FCE0491');
        $this->addSql('ALTER TABLE fromage_enseigne DROP FOREIGN KEY FK_B9EC0F5C6C2A0A71');
        $this->addSql('ALTER TABLE fromage_accord DROP FOREIGN KEY FK_D5CF53D47FCE0491');
        $this->addSql('ALTER TABLE fromage_accord DROP FOREIGN KEY FK_D5CF53D41EDF023F');
        $this->addSql('DROP TABLE fromage_enseigne');
        $this->addSql('DROP TABLE fromage_accord');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE fromage DROP FOREIGN KEY FK_BFBF0C89A76ED395');
        $this->addSql('ALTER TABLE fromage DROP FOREIGN KEY FK_BFBF0C89BCF5E72D');
        $this->addSql('DROP INDEX IDX_BFBF0C89A76ED395 ON fromage');
        $this->addSql('DROP INDEX IDX_BFBF0C89BCF5E72D ON fromage');
        $this->addSql('ALTER TABLE fromage DROP user_id, DROP categorie_id');
    }
}
