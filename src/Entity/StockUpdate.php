<?php


namespace App\Entity;


class StockUpdate
{
    /**
     * @var string
     */
    private $dateUpdate;
    /**
     * @var int
     */
    private $quantityUpdate;

    /**
     * StockUpdate constructor.
     * @param int $quantityUpdate
     */
    public function __construct(int $quantityUpdate)
    {
        $this->dateUpdate = date("d-m-Y H:i:s");
        $this->quantityUpdate = $quantityUpdate;
    }

    /**
     * @return string
     */
    public function getDateUpdate(): string
    {
        return $this->dateUpdate;
    }

    /**
     * @param string $dateUpdate
     */
    public function setDateUpdate(string $dateUpdate): void
    {
        $this->dateUpdate = $dateUpdate;
    }



    /**
     * @return int
     */
    public function getQuantityUpdate(): int
    {
        return $this->quantityUpdate;
    }

    /**
     * @param int $quantityUpdate
     */
    public function setQuantityUpdate(int $quantityUpdate): void
    {
        $this->quantityUpdate = $quantityUpdate;
    }




}