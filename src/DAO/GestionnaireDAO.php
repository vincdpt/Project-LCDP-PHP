<?php

namespace PPE_PHP\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use PPE_PHP\Domain\Gestionnaire;

class GestionnaireDAO extends DAO
{
    /**
     * Return a list of all gestionnaire, sorted by date (most recent first).
     *
     * @return array A list of all gestionnaire.
     */
    public function findAll() {
        $sql = "select * from gestionnaire";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $gestionnaire = array();
        foreach ($result as $row) {
            $login = $row['login'];
            $gestionnaire[$login] = $this->buildDomainObject($row);
        }
        return $gestionnaire;
    }

    /**
     * Returns an gestionnaire matching the supplied login.
     *
     * @param integer $login The gestionnaire login.
     *
     * @return \PPE_PHP\Domain\Gestionnaire|throws an exception if no matching gestionnaire is found
     */
    public function find($login) {
        $sql = "select * from gestionnaire where login=?";
        $row = $this->getDb()->fetchAssoc($sql, array($login));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No gestionnaire matching login " . $login);
    }

    /**
     * Saves an gestionnaire into the database.
     *
     * @param \PPE_PHP\Domain\Gestionnaire $gestionnaire The gestionnaire to save
     */
    public function save(Gestionnaire $gestionnaire) {
        $gestionnaireData = array(
            'login' => $gestionnaire->getLoginGestionnaire(),
            'mdp' => $gestionnaire->getMdpGestionnaire(),
            );

        if ($gestionnaire->getLoginGestionnaire()) {
            // The gestionnaire has already been saved : update it
            $this->getDb()->update('gestionnaire', $gestionnaireData, array('login' => $gestionnaire->getLoginGestionnaire()));
        } else {
            // The gestionnaire has never been saved : insert it
            $this->getDb()->insert('gestionnaire', $gestionnaireData);
            // Get the login of the newly created gestionnaire and set it on the entity.
            $login = $this->getDb()->lastInsertId();
            $gestionnaire->setLoginGestionnaire($login);
        }
    }

    /**
     * Removes an gestionnaire from the database.
     *
     * @param integer $login The gestionnaire login.
     */
    public function delete($login) {
        // Delete the gestionnaire
        $this->getDb()->delete('gestionnaire', array('login' => $login));
    }

    public function loadUserByUsername($login)
    {
        $sql = "select * from gestionnaire where login=?";
        $row = $this->getDb()->fetchAssoc($sql, array($login));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('login "%s" not found.', $login));
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $login)
    {
        $class = get_class($login);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($login->getLoginGestionnaire());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'PPE_php\Domain\Gestionnaire' === $class;
    }

    /**
     * Creates an gestionnaire object based on a DB row.
     *
     * @param array $row The DB row containing gestionnaire data.
     * @return \PPE_PHP\Domain\Gestionnaire
     */
    protected function buildDomainObject($row) {
        $gestionnaire = new Gestionnaire();
        $gestionnaire->setLoginGestionnaire($row['login']);
        $gestionnaire->SetMdpGestionnaire($row['mdp']);
        return $gestionnaire;
    }
}
