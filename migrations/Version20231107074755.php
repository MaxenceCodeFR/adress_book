<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231107074755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE group_contact (group_id INT NOT NULL, contact_id INT NOT NULL, INDEX IDX_CA62B234FE54D947 (group_id), INDEX IDX_CA62B234E7A1254A (contact_id), PRIMARY KEY(group_id, contact_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE group_contact ADD CONSTRAINT FK_CA62B234FE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_contact ADD CONSTRAINT FK_CA62B234E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE group_contact DROP FOREIGN KEY FK_CA62B234FE54D947');
        $this->addSql('ALTER TABLE group_contact DROP FOREIGN KEY FK_CA62B234E7A1254A');
        $this->addSql('DROP TABLE group_contact');
    }
}
