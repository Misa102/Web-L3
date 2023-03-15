<?php

namespace App\Entity;

use App\Repository\MagasinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'ts_magasins')]
#[ORM\Entity(repositoryClass: MagasinRepository::class)]
class Magasin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        max: 255,
        maxMessage: 'La taille du nom est trop grande ; la limite est {{ limit }}',
    )]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'magasin', targetEntity: ProduitMagasin::class)]
    #[Assert\Valid]
    private Collection $produitMagasins;


    /**
     * Magasin constructor
     */
    public function __construct()
    {
        $this->produitMagasins = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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
            $produitMagasin->setMagasin($this);
        }

        return $this;
    }

    public function removeProduitMagasin(ProduitMagasin $produitMagasin): self
    {
        if ($this->produitMagasins->removeElement($produitMagasin)) {
            // set the owning side to null (unless already changed)
            if ($produitMagasin->getMagasin() === $this) {
                $produitMagasin->setMagasin(null);
            }
        }

        return $this;
    }
}
