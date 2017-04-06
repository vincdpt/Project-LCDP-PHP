<?php

namespace PPE_PHP\DAO;

use PPE_PHP\Domain\Specialite;

class SpecialiteDAO extends DAO
{
    /**
     * Return a list of all specialite, sorted by date (most recent first).
     *
     * @return array A list of all specialite.
     */
    public function findAll() {
        $sql = "select * from specialite";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $specialite = array();
        foreach ($result as $row) {
            $id_specialite = $row['id_specialite'];
            $specialite[$id_specialite] = $this->buildDomainObject($row);
        }
        return $specialite;
    }

    /**
     * Returns an specialite matching the supplied id.
     *
     * @param integer $id The specialite id.
     *
     * @return \PPE_PHP\Domain\Specialite|throws an exception if no matching specialite is found
     */
    public function find($id_specialite) {
        $sql = "select * from specialite where id_specialite=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id_specialite));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No specialite matching id " . $id_specialite);
    }

    /**
     * Saves an specialite into the database.
     *
     * @param \PPE_PHP\Domain\Specialite $specialite The Specialite to save
     */
    public function save(Specialite $specialite) {
        $specialiteData = array(
            'id_specialite' => $specialite->getIdSpecialite(),
            'specialite_praticien' => $specialite->getSpecialitePraticien(),
            );

        if ($specialite->getIdSpecialite()) {
            // The specialite has already been saved : update it
            $this->getDb()->update('specialite', $specialiteData, array('id_specialite' => $specialite->getIdSpecialite()));
        } else {
            // The specialite has never been saved : insert it
            $this->getDb()->insert('specialite', $specialiteData);
            // Get the id of the newly created specialite and set it on the entity.
            $id_specialite = $this->getDb()->lastInsertId();
            $specialite->setIdSpecialite($id_specialite);
        }
    }

    /**
     * Removes an specialite from the database.
     *
     * @param integer $id_specialite The specialite id.
     */
    public function delete($id_specialite) {
        // Delete the specialite
        $this->getDb()->delete('specialite', array('id_specialite' => $id_specialite));
    }

    /**
     * Creates an specialite object based on a DB row.
     *
     * @param array $row The DB row containing specialite data.
     * @return \PPE_PHP\Domain\Specialite
     */
    protected function buildDomainObject($row) {
        $specialite = new Specialite();
        $specialite->setIdSpecialite($row['id_specialite']);
        $specialite->setSpecialitePraticien($row['specialite_praticien']);
        return $specialite;
    }
}
