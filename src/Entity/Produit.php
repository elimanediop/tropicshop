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
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="no")
     */
    private $store;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", nullable=true)
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
        $this->store = new ArrayCollection();
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

    /**
     * @return Collection|Store[]
     */
    public function getStore(): Collection
    {
        return $this->store;
    }

    public function addStore(Store $store): self
    {
        if (!$this->store->contains($store)) {
            $this->store[] = $store;
            $store->setNo($this);
        }

        return $this;
    }

    public function removeStore(Store $store): self
    {
        if ($this->store->contains($store)) {
            $this->store->removeElement($store);
            // set the owning side to null (unless already changed)
            if ($store->getNo() === $this) {
                $store->setNo(null);
            }
        }

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

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
}
