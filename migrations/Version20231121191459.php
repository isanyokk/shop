<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231121191459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE param_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE param_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE param (id INT NOT NULL, type_id INT NOT NULL, value VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A4FA7C89C54C8C93 ON param (type_id)');
        $this->addSql('COMMENT ON COLUMN param.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE param_type (id INT NOT NULL, value VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN param_type.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product_param (product_id INT NOT NULL, param_id INT NOT NULL, PRIMARY KEY(product_id, param_id))');
        $this->addSql('CREATE INDEX IDX_5A607D54584665A ON product_param (product_id)');
        $this->addSql('CREATE INDEX IDX_5A607D55647C863 ON product_param (param_id)');
        $this->addSql('ALTER TABLE param ADD CONSTRAINT FK_A4FA7C89C54C8C93 FOREIGN KEY (type_id) REFERENCES param_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_param ADD CONSTRAINT FK_5A607D54584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_param ADD CONSTRAINT FK_5A607D55647C863 FOREIGN KEY (param_id) REFERENCES param (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE param_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE param_type_id_seq CASCADE');
        $this->addSql('ALTER TABLE param DROP CONSTRAINT FK_A4FA7C89C54C8C93');
        $this->addSql('ALTER TABLE product_param DROP CONSTRAINT FK_5A607D54584665A');
        $this->addSql('ALTER TABLE product_param DROP CONSTRAINT FK_5A607D55647C863');
        $this->addSql('DROP TABLE param');
        $this->addSql('DROP TABLE param_type');
        $this->addSql('DROP TABLE product_param');
    }
}
