<?php

namespace App\Entity;

use App\Repository\OrigineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrigineRepository::class)
 */
class Origine
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $alpha_2;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $alpha_3;

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

    public function getAlpha2(): ?string
    {
        return $this->alpha_2;
    }

    public function setAlpha2(string $alpha_2): self
    {
        $this->alpha_2 = $alpha_2;

        return $this;
    }

    public function getAlpha3(): ?string
    {
        return $this->alpha_3;
    }

    public function setAlpha3(string $alpha_3): self
    {
        $this->alpha_3 = $alpha_3;

        return $this;
    }
}
