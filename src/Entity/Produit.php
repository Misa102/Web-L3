<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'ts_produits')]
#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $denomination = null;

    #[ORM\Column(type: Types::STRING, length: 30, options: ['comment' => 'code barre'])]
    private ?string $code = null;

    #[ORM\Column(name: 'date_creation', type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => false])]
    private ?bool $actif = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptif = null;

    #[ORM\OneToOne(targetEntity: Manuel::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(
        name: 'id_manuel',
        referencedColumnName: 'id',    // inutile : valeur par défaut
        unique: true,                  // inutile : valeur par défaut
        nullable: true,                // inutile : valeur par défaut
        options: ['default' => null],  // inutile : valeur par défaut
    )]
    private ?Manuel $manuel = null;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Image::class)]
    private Collection $images;

    #[ORM\ManyToMany(targetEntity: Pays::class, inversedBy: 'produits')]
    #[ORM\JoinTable(name: 'ts_produits_pays')]
    #[ORM\JoinColumn(name: 'id_produit', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'id_pays', referencedColumnName: 'id')]
    private Collection $payss;         // double 's' pour visualiser le pluriel

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: ProduitMagasin::class)]
    private Collection $produitMagasins;


    /**
     * Produit constructor
     */
    public function __construct()
    {
        $this->actif = false;
        $this->manuel = null;
        $this->images = new ArrayCollection();
        $this->payss = new ArrayCollection();
        $this->produitMagasins = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination(string $denomination): self
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getManuel(): ?Manuel
    {
        return $this->manuel;
    }

    public function setManuel(?Manuel $manuel): self
    {
        $this->manuel = $manuel;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setProduit($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProduit() === $this) {
                $image->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Pays>
     */
    public function getPayss(): Collection
    {
        return $this->payss;
    }

    public function addPays(Pays $pays): self
    {
        if (!$this->payss->contains($pays)) {
            $this->payss->add($pays);
            // ne faudrait-il pas appeler $pays->addProduit($this) ?
        }

        return $this;
    }

    public function removePays(Pays $pays): self
    {
        $this->payss->removeElement($pays);
        // si l'appel ci-dessus ok, ne faudrait-il pas appeler $pays->removeProduit($this) ?

        return $this;
    }

    /**
     * @return Collection<int, ProduitMagasin>
     */
    public function getProduitMagasins(): Collection
    {
        return $this->produitMagasins;
    }

    public function addProduitMagasin(ProduitMagasin $produitMagasin): self
    {
        if (!$this->produitMagasins->contains($produitMagasin)) {
            $this->produitMagasins->add($produitMagasin);
            $produitMagasin->setProduit($this);
        }

        return $this;
    }

    public function removeProduitMagasin(ProduitMagasin $produitMagasin): self
    {
        if ($this->produitMagasins->removeElement($produitMagasin)) {
            // set the owning side to null (unless already changed)
            if ($produitMagasin->getProduit() === $this) {
                $produitMagasin->setProduit(null);
            }
        }

        return $this;
    }
}
