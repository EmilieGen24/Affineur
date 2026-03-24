<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260324162924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fromage ADD image_name VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE fromage ADD CONSTRAINT FK_BFBF0C89A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE fromage ADD CONSTRAINT FK_BFBF0C89BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE fromage_enseigne ADD CONSTRAINT FK_B9EC0F5C7FCE0491 FOREIGN KEY (fromage_id) REFERENCES fromage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fromage_enseigne ADD CONSTRAINT FK_B9EC0F5C6C2A0A71 FOREIGN KEY (enseigne_id) REFERENCES enseigne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fromage_accord ADD CONSTRAINT FK_D5CF53D47FCE0491 FOREIGN KEY (fromage_id) REFERENCES fromage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fromage_accord ADD CONSTRAINT FK_D5CF53D41EDF023F FOREIGN KEY (accord_id) REFERENCES accord (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fromage DROP FOREIGN KEY FK_BFBF0C89A76ED395');
        $this->addSql('ALTER TABLE fromage DROP FOREIGN KEY FK_BFBF0C89BCF5E72D');
        $this->addSql('ALTER TABLE fromage DROP image_name, DROP updated_at');
        $this->addSql('ALTER TABLE fromage_accord DROP FOREIGN KEY FK_D5CF53D47FCE0491');
        $this->addSql('ALTER TABLE fromage_accord DROP FOREIGN KEY FK_D5CF53D41EDF023F');
        $this->addSql('ALTER TABLE fromage_enseigne DROP FOREIGN KEY FK_B9EC0F5C7FCE0491');
        $this->addSql('ALTER TABLE fromage_enseigne DROP FOREIGN KEY FK_B9EC0F5C6C2A0A71');
    }
}
