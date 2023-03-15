<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230108094313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ts_magasins (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE ts_produits_magasins (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_produit INTEGER NOT NULL, id_magasin INTEGER NOT NULL, quantite INTEGER NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, CONSTRAINT FK_BFBA5833F7384557 FOREIGN KEY (id_produit) REFERENCES ts_produits (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BFBA58338A32F657 FOREIGN KEY (id_magasin) REFERENCES ts_magasins (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_BFBA5833F7384557 ON ts_produits_magasins (id_produit)');
        $this->addSql('CREATE INDEX IDX_BFBA58338A32F657 ON ts_produits_magasins (id_magasin)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFBA5833F73845578A32F657 ON ts_produits_magasins (id_produit, id_magasin)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ts_magasins');
        $this->addSql('DROP TABLE ts_produits_magasins');
    }
}
