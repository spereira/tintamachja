<?php

namespace TINTA\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class Utilisateur implements UserInterface
{
    /**
     * id de l'utilisateur.
     *
     * @var integer
     */
    private $id;


    /**
     * username de l'utilisateur.
     *
     * @var string
     */
    private $username;
    
    /**
     * mot de passe de l'utilisateur.
     *
     * @var string
     */
    private $password;

    /**
     * Salt that was originally used to encode the password.
     *
     * @var string
     */
    private $salt;

    /**
     * Role.
     * Values : ROLE_USER or ROLE_ADMIN.
     *
     * @var string
     */
    private $role;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
  
        /**
     * @inheritDoc
     */
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @inheritDoc
     */
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * @inheritDoc
     */
  public function getRoles()
    {
        return array($this->getRole());
    }
    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        // Nothing to do here
    }
}