<?php

namespace PPE_PHP\Domain;

class Famille
{
    /**
     * Famille id_famille.
     *
     * @var integer
     */
    private $id_famille;

    /**
     * Famille famille_produit.
     *
     * @var integer
     */
    private $famille_produit;


    // id_famille
    public function getIdFamille() {
        return $this->id_famille;
    }

    public function setIdFamille($id_famille) {
        $this->id_famille = $id_famille;
    }

    // famille_produit
    public function getFamilleProduit() {
        return $this->famille_produit;
    }

    public function setFamilleProduit($famille_produit) {
        $this->famille_produit = $famille_produit;
    }


}
