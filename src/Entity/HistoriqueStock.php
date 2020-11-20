<?php

namespace App\Entity;

use App\Repository\HistoriqueStockRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoriqueStockRepository::class)
 */
class HistoriqueStock
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Stock::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $stock;

    /**
     * @ORM\Column(type="array")
     */
    private $dateUpdate = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(Stock $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getDateUpdate(): ?array
    {
        return $this->dateUpdate;
    }

    public function setDateUpdate(StockUpdate $dateUpdate): self
    {
        $this->dateUpdate[] = $dateUpdate;

        return $this;
    }
}
