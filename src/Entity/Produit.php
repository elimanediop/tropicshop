<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Origine::class)
     */
    private $origine;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $images = [];

    /**
     * @var $imagesproduit string
     */
    private $imagesproduit;

    /**
     * @ORM\ManyToOne(targetEntity=TypeProduit::class)
     */
    private $typeproduit;


    /**
     * @ORM\Column(type="boolean")
     */
    private $isdefault = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typevente;

    /**
     * @return string
     */
    public function getImagesproduit(): ?string
    {
        return $this->imagesproduit;
    }

    /**
     * @param string $imagesproduit
     */
    public function setImagesproduit(?string $imagesproduit): self
    {
        $this->imagesproduit = $imagesproduit;
        return $this;
    }

    public function __construct()
    {
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOrigine(): ?Origine
    {
        return $this->origine;
    }

    public function setOrigine(?Origine $origine): self
    {
        $this->origine = $origine;

        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(string $imageid): self
    {
        $this->images[] = $imageid;

        return $this;
    }

    public function getTypeproduit(): ?TypeProduit
    {
        return $this->typeproduit;
    }

    public function setTypeproduit(?TypeProduit $typeproduit): self
    {
        $this->typeproduit = $typeproduit;

        return $this;
    }

    public function getIsdefault(): ?bool
    {
        return $this->isdefault;
    }

    public function setIsdefault(bool $isdefault): self
    {
        $this->isdefault = $isdefault;

        return $this;
    }

    public function getTypevente(): ?string
    {
        return $this->typevente;
    }

    public function setTypevente(?string $typevente): self
    {
        $this->typevente = $typevente;

        return $this;
    }
}
