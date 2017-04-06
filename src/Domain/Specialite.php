<?php

namespace PPE_PHP\Domain;

class Specialite
{
    /**
     * Specialite id_specialite.
     *
     * @var integer
     */
    private $id_specialite;

    /**
     * Specialite specialite_praticien.
     *
     * @var integer
     */
    private $specialite_praticien;


    // id_specialite
    public function getIdSpecialite() {
        return $this->id_specialite;
    }

    public function setIdSpecialite($id_specialite) {
        $this->id_specialite = $id_specialite;
    }

    // specialite_praticien
    public function getSpecialitePraticien() {
        return $this->specialite_praticien;
    }

    public function setSpecialitePraticien($specialite_praticien) {
        $this->specialite_praticien = $specialite_praticien;
    }


}
