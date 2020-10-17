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
     * @ORM\Column(type="string", length=2)
     */
    private $alpha_2;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $alpha_3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\OneToOne(targetEntity=ProduitStore::class, mappedBy="origine", cascade={"persist", "remove"})
     */
    private $typevente;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getTypevente(): ?ProduitStore
    {
        return $this->typevente;
    }

    public function setTypevente(?ProduitStore $typevente): self
    {
        $this->typevente = $typevente;

        // set (or unset) the owning side of the relation if necessary
        $newOrigine = null === $typevente ? null : $this;
        if ($typevente->getOrigine() !== $newOrigine) {
            $typevente->setOrigine($newOrigine);
        }

        return $this;
    }
}
