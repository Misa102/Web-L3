<?php

namespace App\Entity;

use App\Repository\ProduitMagasinRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'ts_produits_magasins')]
#[ORM\UniqueConstraint(columns: ['id_produit', 'id_magasin'])]
#[ORM\Entity(repositoryClass: ProduitMagasinRepository::class)]
#[UniqueEntity(
    fields: ['produit', 'magasin'],                 // ce sont les noms des membres de la classe
    errorPath: false,                               // par défaut, message en haut du formulaire
    message: 'cette relation est déjà présente',
)]
class ProduitMagasin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'produitMagasins')]
    #[ORM\JoinColumn(name: 'id_produit', nullable: false)]
    #[Assert\NotNull]
    #[Assert\Valid]
    private ?Produit $produit = null;

    #[ORM\ManyToOne(targetEntity: Magasin::class, inversedBy: 'produitMagasins')]
    #[ORM\JoinColumn(name: 'id_magasin', nullable: false)]
    #[Assert\NotNull]
    #[Assert\Valid]
    private ?Magasin $magasin = null;

    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\Range(
        minMessage: 'la quantité minimale est {{ limit }}',
        min: 0,
    )]
    private ?int $quantite = null;

    #[ORM\Column(name: 'prix_unitaire', type: Types::FLOAT)]
    #[Assert\Range(
        minMessage: 'pas de prix négatif',
        min: 0,
    )]
    private ?float $prixUnitaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;
        // ne faudrait-il pas appeler $produit->addProduitMagasin($this); ?

        return $this;
    }

    public function getMagasin(): ?Magasin
    {
        return $this->magasin;
    }

    public function setMagasin(?Magasin $magasin): self
    {
        $this->magasin = $magasin;
        // ne faudrait-il pas appeler $magasin->addProduitMagasin($this); ?

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): self
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }
}
