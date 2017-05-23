<?php
namespace PPE_PHP\DAO;
use PPE_PHP\Domain\Visiteur;
class VisiteurDAO extends DAO
{
    /**
     * Return a list of all vendeurs, sorted by cp.
     *
     * @return array A list of all visiteurs.
     */
    public function findAll() {
        $sql = "select * from visiteur order by id_visiteur";
        $result = $this->getDb()->fetchAll($sql);
        // Convert query result to an array of domain objects
        $visiteurs = array();
        foreach ($result as $row) {
            $id_visiteur = $row['id_visiteur'];
            $visiteurs[$id_visiteur] = $this->buildDomainObject($row);
        }
        return $visiteurs;
    }

    /**
     * Returns the name of the secteur.
     *
     * @param integer $id The visiteur id.
     *
     * @return string of the response
     */
    public function findSecteurName($id_visiteur) {
        $sql = "select secteur_intervention from secteur INNER JOIN visiteur on secteur.id_secteur = visiteur.id_secteur where id_visiteur=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id_visiteur));
        $rep = $row['secteur_intervention'];
        return $rep;
    }



    /**
     * Returns an visiteur matching the supplied id.
     *
     * @param integer $id The visiteur id.
     *
     * @return \PPE_PHP\Domain\Visiteur|throws an exception if no matching visiteur is found
     */
    public function find($id_visiteur) {
        $sql = "select * from visiteur where id_visiteur=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));
        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No visiteur matching id " . $id_visiteur);
    }
    /**
     * Saves an visiteur into the database.
     *
     * @param \MicroCMS\Domain\Visiteur $visiteur The visiteur to save
     */
    public function save(Visiteur $visiteur) {
        $visiteurData = array(
            'id_visiteur' => $visiteur->getIdVisiteur(),
            'id_secteur' => $visiteur->getIdSecteur(),
            'nom' => $visiteur->getNom(),
            'prenom' => $visiteur->getPrenom(),
            'login' => $visiteur->getLogin(),
            'mdp' => $visiteur->getMdp(),
            'adresse' => $visiteur->getAdresse(),
            'cp' => $visiteur->getCp(),
            'ville' => $visiteur->getVille(),
            'dateEmbauche' => $visiteur->getDateEmbauche(),
            'Privileges' => $visiteur->getPrivileges(),
        );
        if ($visiteur->getIdVisiteur()) {
            // The visiteur has already been saved : update it
            $this->getDb()->update('visiteur', $visiteurData, array('id_visiteur' => $visiteur->getIdVisiteur()));
        } else {
            // The visiteur has never been saved : insert it
            $this->getDb()->insert('visiteur', $visiteurData);
            // Get the id of the newly created visiteur and set it on the entity.
            $id_visiteur = $this->getDb()->lastInsertId();
            $visiteur->setIdVisiteur($id_visiteur);
        }
    }
    /**
     * Removes an visiteur from the database.
     *
     * @param integer $id_visiteur The visiteur id.
     */
    public function delete($id_visiteur) {
        // Delete the visiteur
        $this->getDb()->delete('visiteur', array('id_visiteur' => $id_visiteur));
    }
    /**
     * Creates an Visiteur object based on a DB row.
     *
     * @param array $row The DB row containing Visiteur data.
     * @return \MicroCMS\Domain\Visiteur
     */
    protected function buildDomainObject(array $row) {

        $secteurIntervention = $this->findSecteurName($row['id_secteur']);
        $visiteur = new Visiteur();
        $visiteur->setIdVisiteur($row['id_visiteur']);
        $visiteur->setIdSecteur($row['id_secteur']);
        $visiteur->setSecteurIntervention($secteurIntervention);
        $visiteur->setNom($row['nom']);
        $visiteur->setPrenom($row['prenom']);
        $visiteur->setLogin($row['login']);
        $visiteur->setMdp($row['mdp']);
        $visiteur->setAdresse($row['adresse']);
        $visiteur->setCp($row['cp']);
        $visiteur->setVille($row['ville']);
        $visiteur->setDateEmbauche($row['dateEmbauche']);
        $visiteur->setPrivileges($row['Privileges']);
        return $visiteur;
    }
}
