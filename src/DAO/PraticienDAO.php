<?php

namespace PPE_PHP\DAO;

use PPE_PHP\Domain\Praticien;

class PraticienDAO extends DAO
{
    /**
     * Return a list of all praticien, sorted by date (most recent first).
     *
     * @return array A list of all praticien.
     */
    public function findAll() {
        $sql = "select * from praticien";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $praticien = array();
        foreach ($result as $row) {
            $praticienID = $row['id_praticien'];
            $praticien[$praticienID] = $this->buildDomainObject($row);
        }
        return $praticien;
    }

    /**
     * Returns an praticien matching the supplied id.
     *
     * @param integer $id The praticien id.
     *
     * @return \PPE_PHP\Domain\Praticien|throws an exception if no matching praticien is found
     */
    public function find($id_praticien) {
        $sql = "select * from praticien where id_praticien=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id_praticien));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No praticien matching id " . $id_praticien);
    }

    /**
     * Saves an praticien into the database.
     *
     * @param \PPE_PHP\Domain\Praticien $praticien The praticien to save
     */
    public function save(Praticien $praticien) {
        $praticienData = array(
            'id_praticien' => $praticien->getIdPraticien(),
            'id_specialite' => $praticien->getIdSpecialite(),
            'raison_sociale' => $praticien->getRaisonSociale(),
            'adresse' => $praticien->getAdresse(),
            'telephone' => $praticien->getTelephone(),
            'nom' => $praticien->getNom(),
            'mail' => $praticien->getMail(),
            'coeff_notoriete' => $praticien->getCoeff_notoriete(),
            'coeff_confiance' => $praticien->getCoeff_confiance(),
            'type' => $praticien->getType(),
            );

        if ($praticien->getIdPraticien()) {
            // The praticien has already been saved : update it
            $this->getDb()->update('praticien', $praticienData, array('id_praticien' => $praticien->getIdPraticien()));
        } else {
            // The praticien has never been saved : insert it
            $this->getDb()->insert('praticien', $praticienData);
            // Get the id of the newly created praticien and set it on the entity.
            $id_praticien = $this->getDb()->lastInsertId();
            $praticien->setIdPraticien($id_praticien);
        }
    }

    /**
     * Removes an praticien from the database.
     *
     * @param integer $id_praticien The praticien id.
     */
    public function delete($id_praticien) {
        // Delete the praticien
        $this->getDb()->delete('praticien', array('id_praticien' => $id_praticien));
    }

    /**
     * Creates an praticien object based on a DB row.
     *
     * @param array $row The DB row containing Praticien data.
     * @return \PPE_PHP\Domain\Praticien
     */
    protected function buildDomainObject($row) {
        $praticien = new Praticien();
        $praticien->setIdPraticien($row['id_praticien']);
        $praticien->setIdSpecialite($row['id_specialite']);
        $praticien->setRaisonSociale($row['raison_sociale']);
        $praticien->setAdresse($row['adresse']);
        $praticien->setTelephone($row['telephone']);
        $praticien->setNom($row['nom']);
        $praticien->setMail($row['mail']);
        $praticien->setCoeff_notoriete($row['coeff_notoriete']);
        $praticien->setCoeff_confiance($row['coeff_confiance']);
        $praticien->setType($row['type']);
        return $praticien;
    }
}
