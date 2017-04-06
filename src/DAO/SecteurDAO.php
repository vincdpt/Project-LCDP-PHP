<?php

namespace PPE_PHP\DAO;

use PPE_PHP\Domain\Secteur;

class SecteurDAO extends DAO
{
    /**
     * Return a list of all secteur, sorted by date (most recent first).
     *
     * @return array A list of all secteur.
     */
    public function findAll() {
        $sql = "select * from secteur";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $secteur = array();
        foreach ($result as $row) {
            $id_secteur = $row['id_secteur'];
            $secteur[$id_secteur] = $this->buildDomainObject($row);
        }
        return $secteur;
    }

    /**
     * Returns an secteur matching the supplied id.
     *
     * @param integer $id The secteur id.
     *
     * @return \PPE_PHP\Domain\Secteur|throws an exception if no matching secteur is found
     */
    public function find($id_secteur) {
        $sql = "select * from secteur where id_secteur=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id_secteur));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No secteur matching id " . $id_secteur);
    }

    /**
     * Saves an secteur into the database.
     *
     * @param \PPE_PHP\Domain\Secteur $secteur The Secteur to save
     */
    public function save(Secteur $secteur) {
        $secteurData = array(
            'id_secteur' => $secteur->getIdSecteur(),
            'secteur_intervention' => $secteur->getSecteurIntervention(),
            );

        if ($secteur->getIdSecteur()) {
            // The secteur has already been saved : update it
            $this->getDb()->update('secteur', $secteurData, array('id_secteur' => $secteur->getIdSecteur()));
        } else {
            // The secteur has never been saved : insert it
            $this->getDb()->insert('secteur', $secteurData);
            // Get the id of the newly created secteur and set it on the entity.
            $id_secteur = $this->getDb()->lastInsertId();
            $secteur->setIdSecteur($id_secteur);
        }
    }

    /**
     * Removes an secteur from the database.
     *
     * @param integer $id_secteur The secteur id.
     */
    public function delete($id_secteur) {
        // Delete the secteur
        $this->getDb()->delete('secteur', array('id_secteur' => $id_secteur));
    }

    /**
     * Creates an secteur object based on a DB row.
     *
     * @param array $row The DB row containing Secteur data.
     * @return \PPE_PHP\Domain\Secteur
     */
    protected function buildDomainObject($row) {
        $secteur = new Secteur();
        $secteur->setIdSecteur($row['id_secteur']);
        $secteur->setSecteurIntervention($row['secteur_intervention']);
        return $secteur;
    }
}
