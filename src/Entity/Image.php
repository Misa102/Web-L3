<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'ts_images')]
#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $url = null;

    #[ORM\Column(
        name: 'url_mini',                  // inutile car déduit automatiquement
        type: Types::STRING,               // inutile car déduit automatiquement
        length: 255,
        nullable: true,
        options: ['default' => null],      // inutile car directive par défaut
    )]
    private ?string $urlMini = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $alt = null;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'images')]
    #[ORM\JoinColumn(name: 'id_produit', nullable: false)]
    private ?Produit $produit = null;


    /**
     * Image constructor
     */
    public function __construct()
    {
        $this->urlMini = null;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getUrlMini(): ?string
    {
        return $this->urlMini;
    }

    public function setUrlMini(?string $urlMini): self
    {
        $this->urlMini = $urlMini;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
