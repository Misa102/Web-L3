<?php

namespace App\Entity;

use App\Repository\ManuelRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'ts_manuels')]
#[ORM\Entity(repositoryClass: ManuelRepository::class)]
class Manuel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $url = null;

    #[ORM\Column(type: Types::TEXT, nullable: true, options: ['default' => null])]
    private ?string $sommaire = null;


    /**
     * Manuel constructor
     */
    public function __construct()
    {
        $this->sommaire = null;
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

    public function getSommaire(): ?string
    {
        return $this->sommaire;
    }

    public function setSommaire(?string $sommaire): self
    {
        $this->sommaire = $sommaire;

        return $this;
    }
}
