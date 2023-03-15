<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230107200621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ts_pays (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, code VARCHAR(2) DEFAULT NULL --iso 3166 alpha 2
        )');
        $this->addSql('CREATE TABLE ts_produits_pays (id_produit INTEGER NOT NULL, id_pays INTEGER NOT NULL, PRIMARY KEY(id_produit, id_pays), CONSTRAINT FK_A76ED39BF7384557 FOREIGN KEY (id_produit) REFERENCES ts_produits (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A76ED39BBFBF20AC FOREIGN KEY (id_pays) REFERENCES ts_pays (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_A76ED39BF7384557 ON ts_produits_pays (id_produit)');
        $this->addSql('CREATE INDEX IDX_A76ED39BBFBF20AC ON ts_produits_pays (id_pays)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ts_pays');
        $this->addSql('DROP TABLE ts_produits_pays');
    }
}
