<?php

namespace PPE_PHP\Domain;

class Secteur
{
    /**
     * Secteur id_secteur.
     *
     * @var integer
     */
    private $id_secteur;

    /**
     * Secteur secteur_intervention.
     *
     * @var integer
     */
    private $secteur_intervention;


    // id_secteur
    public function getIdSecteur() {
        return $this->id_secteur;
    }

    public function setIdSecteur($id_secteur) {
        $this->id_secteur = $id_secteur;
    }

    // secteur_intervention
    public function getSecteurIntervention() {
        return $this->secteur_intervention;
    }

    public function setSecteurIntervention($secteur_intervention) {
        $this->secteur_intervention = $secteur_intervention;
    }


}
