<?php

namespace PPE_PHP\DAO;

use PPE_PHP\Domain\Famille;

class FamilleDAO extends DAO
{
    /**
     * Return a list of all famille, sorted by date (most recent first).
     *
     * @return array A list of all famille.
     */
    public function findAll() {
        $sql = "select * from famille";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $famille = array();
        foreach ($result as $row) {
            $id_famille = $row['id_famille'];
            $famille[$id_famille] = $this->buildDomainObject($row);
        }
        return $famille;
    }

    /**
     * Returns an famille matching the supplied id.
     *
     * @param integer $id The famille id.
     *
     * @return \PPE_PHP\Domain\Famille|throws an exception if no matching famille is found
     */
    public function find($id_famille) {
        $sql = "select * from famille where id_famille=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id_famille));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No famille matching id " . $id_famille);
    }

    /**
     * Saves an famille into the database.
     *
     * @param \PPE_PHP\Domain\Famille $famille The famille to save
     */
    public function save(Famille $famille) {
        $familleData = array(
            'id_famille' => $famille->getIdFamille(),
            'famille_produit' => $famille->getFamilleProduit(),
            );

        if ($famille->getIdFamille()) {
            // The famille has already been saved : update it
            $this->getDb()->update('famille', $familleData, array('id_famille' => $famille->getIdFamille()));
        } else {
            // The famille has never been saved : insert it
            $this->getDb()->insert('famille', $familleData);
            // Get the id of the newly created famille and set it on the entity.
            $id_famille = $this->getDb()->lastInsertId();
            $famille->setIdFamille($id_famille);
        }
    }

    /**
     * Removes an famille from the database.
     *
     * @param integer $id_famille The famille id.
     */
    public function delete($id_famille) {
        // Delete the famille
        $this->getDb()->delete('famille', array('id_famille' => $id_famille));
    }

    /**
     * Creates an famille object based on a DB row.
     *
     * @param array $row The DB row containing Famille data.
     * @return \PPE_PHP\Domain\Famille
     */
    protected function buildDomainObject(array $row) {
        $famille = new Famille();
        $famille->setIdFamille($row['id_famille']);
        $famille->setFamilleProduit($row['famille_produit']);
        return $famille;
    }
}
