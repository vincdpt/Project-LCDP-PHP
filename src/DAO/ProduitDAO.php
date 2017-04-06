<?php

namespace PPE_PHP\DAO;

use PPE_PHP\Domain\Produit;
use PPE_PHP\Domain\Famille;

class ProduitDAO extends DAO
{
    /**
     * Return a list of all produit, sorted by date (most recent first).
     *
     * @return array A list of all produit.
     */
    public function findAll() {
        $sql = "select * from produit";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $produit = array();
        foreach ($result as $row) {
            $id_produit = $row['id_produit'];
            $produit[$id_produit] = $this->buildDomainObject($row);
        }
        return $produit;
    }

    /**
     * Returns an produit matching the supplied id.
     *
     * @param integer $id The produit id.
     *
     * @return \PPE_PHP\Domain\Produit|throws an exception if no matching produit is found
     */
    public function find($id_produit) {
        $sql = "select * from produit where id_produit=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id_produit));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No produit matching id " . $id_produit);
    }

    public function findFamilleName($id_famille) {
        $sql = "select famille_produit from famille where id_famille=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id_famille));

        $rep = $row[0];
        return $rep;
    }

    /**
     * Returns an famille matching the supplied id.
     *
     * @param integer $id The famille id.
     *
     * @return \PPE_PHP\Domain\Famille|throws an exception if no matching famille is found
     */
    public function findFamille($id_famille) {
        $sql = "select * from famille where id_famille=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id_famille));

        if ($row)
            return $this->buildDomainObjectF($row);
        else
            throw new \Exception("No famille matching id " . $id_famille);
    }


    /**
     * Saves an produit into the database.
     *
     * @param \PPE_PHP\Domain\Produit $produit The Produit to save
     */
    public function save(Produit $produit) {
        $produitData = array(
            'id_produit' => $produit->getIdProduit(),
            'id_famille' => $produit->getIdFamille(),
            'nom' => $produit->getNom(),
            'effets' => $produit->getEffets(),
            'contre_indication' => $produit->getContreIndication(),
            'interactions_autres_produits' => $produit->getInteractionsAutresProduits(),
            'presentation' => $produit->getPresentation(),
            'dosage' => $produit->getDosage(),
            'prix_HT' => $produit->getPrixHT(),
            'prix_Echantillon' => $produit->getPrixEchantillon(),
            );

        if ($produit->getIdProduit()) {
            // The produit has already been saved : update it
            $this->getDb()->update('produit', $produitData, array('id_produit' => $produit->getIdProduit()));
        } else {
            // The produit has never been saved : insert it
            $this->getDb()->insert('produit', $produitData);
            // Get the id of the newly created produit and set it on the entity.
            $id_produit = $this->getDb()->lastInsertId();
            $produit->setIdProduit($id_produit);
        }
    }

    /**
     * Removes an produit from the database.
     *
     * @param integer $id_produit The Produit id.
     */
    public function delete($id_produit) {
        // Delete the produit
        $this->getDb()->delete('produit', array('id_produit' => $id_produit));
    }

    /**
     * Creates an famille object based on a DB row.
     *
     * @param array $row The DB row containing Famille data.
     * @return \PPE_PHP\Domain\Famille
     */
    protected function buildDomainObjectF($row) {
        $famille = new Famille();
        $famille->setIdFamille($row['id_famille']);
        $famille->setFamilleProduit($row['famille_produit']);
        return $famille;
    }


    /**
     * Creates an produit object based on a DB row.
     *
     * @param array $row The DB row containing produit data.
     * @return \PPE_PHP\Domain\Produit
     */
    protected function buildDomainObject(array $row) {
        $produit = new Produit();
        $produit->setIdProduit($row['id_produit']);
        $produit->setFamille($this->findFamille($row['id_famille']));
        $produit->setIdFamille($row['id_famille']);
        $produit->setNom($row['nom']);
        $produit->setEffets($row['effets']);
        $produit->setContreIndication($row['contre_indication']);
        $produit->setInteractionsAutresProduits($row['interactions_autres_produits']);
        $produit->setPresentation($row['presentation']);
        $produit->setDosage($row['dosage']);
        $produit->setPrixHT($row['prix_HT']);
        $produit->setPrixEchantillon($row['prix_Echantillon']);
        return $produit;
    }
}
