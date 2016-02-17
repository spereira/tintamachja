<?php

namespace TINTA\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use TINTA\Domain\Utilisateur;

class UtilisateurDAO extends DAO implements UserProviderInterface
{

    /**
     * Renvoie un utilisateur à partir de son identifiant
     *
     * @param integer $id L'identifiant de l'utilisateur
     *
     * @return \TINTA\Domain\Utilisateur|Lève un exception si aucun utilisateur ne correspond
     */
    public function find($id) {
        $sql = "select * from user where USR_ID=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucun UTILISATEUR ne correspond à l'identifiant " . $id);
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $sql = "select * from USER where USR_NAME=?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if ($row)
            return $this->buildDomainObject($row);
        else
throw new UsernameNotFoundException(sprintf('L\'utilisateur n\'a pas été trouvé', $username));
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $utilisateur)
    {
        $class = get_class($utilisateur);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($utilisateur->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'TINTA\Domain\Utilisateur' === $class;
    }

    /**
     * Crée un utilisateur gràce à la ligne récupérée.
     *
     * @param array la ligne contient les informations de l'utilisateur.
     * @return \TINTA\Domain\Visiteur
     */
    protected function buildDomainObject($row) {
    $utilisateur = new Utilisateur();
    $utilisateur->setId($row['USER_ID']);
    $utilisateur->setUsername($row['USER_NAME']);
    $utilisateur->setPassword($row['USER_PASSWORD']);
    $utilisateur->setSalt($row['USER_SALT']);
    $utilisateur->setRole($row['USER_ROLE']);
        return $utilisateur;
    }
}