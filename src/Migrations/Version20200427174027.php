<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200427174027 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE feature CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE pet ADD type_pet_id INT NOT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE size size DOUBLE PRECISION DEFAULT NULL, CHANGE age age INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pet ADD CONSTRAINT FK_E4529B85B5B8148E FOREIGN KEY (type_pet_id) REFERENCES type_pet (id)');
        $this->addSql('CREATE INDEX IDX_E4529B85B5B8148E ON pet (type_pet_id)');
        $this->addSql('ALTER TABLE type_pet CHANGE description description VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE feature CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE pet DROP FOREIGN KEY FK_E4529B85B5B8148E');
        $this->addSql('DROP INDEX IDX_E4529B85B5B8148E ON pet');
        $this->addSql('ALTER TABLE pet DROP type_pet_id, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE size size DOUBLE PRECISION DEFAULT \'NULL\', CHANGE age age INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_pet CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
