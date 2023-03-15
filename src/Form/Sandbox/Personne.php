<?php

namespace App\Form\Sandbox;

use Symfony\Component\Validator\Constraints as Assert;

class Personne
{
    #[Assert\Length(min: 3)]
    private ?string $prenom = null;

    #[Assert\Range(min: 18)]
    private ?int $age = null;

    /**
     * @param string|null $prenom
     * @param int|null $age
     */
    public function __construct(?string $prenom = null, ?int $age = null)
    {
        $this->prenom = $prenom;
        $this->age = $age;
    }

    /**
     * @return string|null
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @param int|null $age
     */
    public function setAge(?int $age): self
    {
        $this->age = $age;
        return $this;
    }
}
