<?php
namespace PPE_PHP\Domain;
class Visiteur
{
    /**
     * Produit id_visiteur.
     *
     * @var integer
     */
    private $id_visiteur;

    /**
     * Produit nom.
     *
     * @var string
     */
    private $nom;
    /**
     * Produit prenom.
     *
     * @var string
     */
    private $prenom;
    /**
     * Produit login.
     *
     * @var string
     */
    private $login;
    /**
     * Produit mdp.
     *
     * @var string
     */
    private $mdp;
    /**
     * Produit adresse.
     *
     * @var string
     */
    private $adresse;
    /**
     * Produit cp.
     *
     * @var string
     */
    private $cp;
    /**
     * Produit ville.
     *
     * @var string
     */
    private $ville;
    /**
     * Produit dateEmbauche.
     *
     * @var date
     */
    private $dateEmbauche;
    /**
     * Produit Privileges.
     *
     * @var integer
     */
    private $Privileges;

    /**
     * Secteur id_secteur.
     *
     * @var integer
     */
    private $id_secteur;

    /**
     * String secteur_intervention.
     *
     * @var string
     */
    private $secteur_intervention;



    // id_visiteur
    public function getIdVisiteur() {
        return $this->id_visiteur;
    }
    public function setIdVisiteur($id_visiteur) {
        $this->id_visiteur = $id_visiteur;
    }
    // id_secteur
    public function getIdSecteur() {
        return $this->id_secteur;
    }
    // nom
    public function getNom() {
        return $this->nom;
    }
    public function setNom($nom) {
        $this->nom = $nom;
    }
    // prenom
    public function getPrenom() {
        return $this->prenom;
    }
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }
    // login
    public function getLogin() {
        return $this->login;
    }
    public function setLogin($login) {
        $this->login = $login;
    }
    // mdp
    public function getMdp() {
        return $this->mdp;
    }
    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }
    // adresse
    public function getAdresse() {
        return $this->adresse;
    }
    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }
    // cp
    public function getCp() {
        return $this->cp;
    }
    public function setCp($cp) {
        $this->cp = $cp;
    }
    // ville
    public function getVille() {
        return $this->ville;
    }
    public function setVille($ville) {
        $this->ville = $ville;
    }
    // dateEmbauche
    public function getDateEmbauche() {
        return $this->dateEmbauche;
    }
    public function setDateEmbauche($dateEmbauche) {
        $this->dateEmbauche = $dateEmbauche;
    }
    // Privileges
    public function getPrivileges() {
        return $this->Privileges;
    }
    public function setPrivileges($Privileges) {
        $this->Privileges = $Privileges;
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