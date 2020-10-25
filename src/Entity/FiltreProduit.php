<?php

namespace App\Entity;

class FiltreProduit
{
    /*
     * dorne prix inférieur
     */
    private $prixInf;
    /*
     * borne prix supérieur
     */
    private $prixSup;
    /*
     * origine du produit
     */
    private $origine;
    /*
     * types des produits
     */
    private $typeProduits;
    /*
     * type de vente kilo|pièce
     */
    private $typeVente;
    /*
     * origine du produit
     */
    private $taille;
    /*
     * magasin pour produits
     */
    private $store;

    /*
     * recherche produit dans magasin 
     */
    private $recherche;

    public function __tostring(){
        return $this->prixInf.$this->prixSup.$this->typeVente.$this->typeProduits.$this->taille.$this->store;
    }

    /**
     * @return mixed
     */
    public function getPrixInf()
    {
        return $this->prixInf;
    }

    /**
     * @param mixed $prixInf
     *
     * @return self
     */
    public function setPrixInf($prixInf)
    {
        $this->prixInf = $prixInf;

        return $this;
    }

        /**
     * @return mixed
     */
    public function getPrixSup()
    {
        return $this->prixSup;
    }

    /**
     * @param mixed $prixInf
     *
     * @return self
     */
    public function setPrixSup($prixSup)
    {
        $this->prixSup = $prixSup;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrigine()
    {
        return $this->origine;
    }

    /**
     * @param mixed $origine
     *
     * @return self
     */
    public function setOrigine($origine)
    {
        $this->origine = $origine;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeProduits()
    {
        return $this->typeProduits;
    }

    /**
     * @param mixed $typeProduit
     *
     * @return self
     */
    public function setTypeProduits($typeProduits)
    {
        $this->typeProduits = $typeProduits;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeVente()
    {
        return $this->typeVente;
    }

    /**
     * @param mixed $typeVente
     *
     * @return self
     */
    public function setTypeVente($typeVente)
    {
        $this->typeVente = $typeVente;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * @param mixed $taille
     *
     * @return self
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @param mixed $store
     *
     * @return self
     */
    public function setStore($store)
    {
        $this->store = $store;

        return $this;
    }
        /**
     * @return mixed
     */
    public function getRecherche()
    {
        return $this->recherche;
    }

    /**
     * @param mixed $recherche
     *
     * @return self
     */
    public function setRecherche($recherche)
    {
        $this->recherche = $recherche;

        return $this;
    }
}
