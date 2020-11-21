<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    public $VALIDE = "validé";
    public $ANNULE = "annulé";
    public $ATTENTE = "attente";
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $client;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $produitStoreList = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getProduitStoreList(): ?array
    {
        return $this->produitStoreList;
    }

    public function setProduitStoreList(array $produitStore): self
    {
        $this->produitStoreList = $produitStore;

        return $this;
    }
}
