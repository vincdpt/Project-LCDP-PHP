<?php

namespace PPE_PHP\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class Gestionnaire
{

    /**
     * Gestionnaire login.
     *
     * @var integer
     */
    private $login;

    /**
     * Gestionnaire mdp.
     *
     * @var integer
     */
    private $mdp;


    // login
    public function getLoginGestionnaire() {
        return $this->login;
    }

    public function setLoginGestionnaire($login) {
        $this->login = $login;
    }

    // mdp
    public function getMdpGestionnaire() {
        return $this->mdp;
    }

    public function SetMdpGestionnaire($mdp) {
        $this->mdp = $mdp;
    }


}
