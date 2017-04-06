
<?php

namespace PPE_PHP\Domain;

class Praticien 
{
    /**
     * Praticien id_praticien.
     *
     * @var integer
     */
    private $id_praticien;

    /**
     * Praticien id_specialite.
     *
     * @var integer
     */
    private $id_specialite;

    /**
     * Praticien raison_sociale.
     *
     * @var string
     */

    private $raison_sociale;

    /**
     * Praticien adresse.
     *
     * @var string
     */
    private $adresse;

    /**
     * Praticien telephone.
     *
     * @var string
     */
    private $telephone;

    /**
     * Praticien nom.
     *
     * @var string
     */
    private $nom;

    /**
     * Praticien mail.
     *
     * @var string
     */
    private $mail;

    /**
     * Praticien coeff_notoriete.
     *
     * @var double
     */
    private $coeff_notoriete;

    /**
     * Praticien coeff_confiance.
     *
     * @var double
     */
    private $coeff_confiance;

    /**
     * Praticien type.
     *
     * @var string
     */
    private $type;
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 // ----------------------------------------------------GETTERS/SETTERS---------------------------------------------------- //
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // id_praticien
    public function getIdPraticien() {
        return $this->id_praticien;
    }

    public function setIdPraticien($id_praticien) {
        $this->id_praticien = $id_praticien;
    }

    // id_specialite
    public function getIdSpecialite() {
        return $this->id_specialite;
    }

    public function setIdSpecialite($id_specialite) {
        $this->id_specialite = $id_specialite;
    }

    // raison_sociale
    public function getRaisonSociale() {
        return $this->raison_sociale;
    }

    public function setRaisonSociale($raison_sociale) {
        $this->raison_sociale = $raison_sociale;
    }

    // adresse
    public function getAdresse() {
        return $this->adresse;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    // telephone
    public function getTelephone() {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    // Nom
    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    // mail
    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    // coeff_notoriete
    public function getCoeff_notoriete() {
        return $this->coeff_notoriete;
    }
    public function setCoeff_notoriete($coeff_notoriete) {
        $this->coeff_notoriete = $coeff_notoriete;
    }

    // coeff_confiance
    public function getCoeff_confiance() {
        return $this->coeff_confiance;
    }
    public function setCoeff_confiance($coeff_confiance) {
        $this->coeff_confiance = $coeff_confiance;
    }

    // type
    public function getType() {
        return $this->type;
    }
    public function setType($type) {
        $this->type = $type;
    }
}
