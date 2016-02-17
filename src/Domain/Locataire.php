<?php

namespace TINTA\Domain;

class Locataire 
{
    /**
     * Identifiant.
     *
     * @var integer
     */
    private $id;

    /**
     * Nom.
     *
     * @var string
     */
    private $nom;
    
     /**
     * Prenom.
     *
     * @var string
     */
    private $prenom;
    
     /**
     * Rue.
     *
     * @var string
     */
    private $rue;
    
     /**
     * Ville.
     *
     * @var string
     */
    private $ville;
    
     /**
     * Code Postal.
     *
     * @var string
     */
    private $cp;
    
     /**
     * Pays.
     *
     * @var string
     */
    private $pays;
    
     /**
     * numéro de téléphone.
     *
     * @var string
     */
    private $tel;
    
     /**
     * Email.
     *
     * @var string
     */
    private $email;
    
     /**
     * Commentaire locataire.
     *
     * @var string
     */
    private $comLoc;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }
    
     public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }
     public function getRue() {
        return $this->rue;
    }

    public function setRue($rue) {
        $this->rue = $rue;
    }
     public function getVille() {
        return $this->ville;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }
     public function getCp() {
        return $this->cp;
    }

    public function setCp($cp) {
        $this->cp = $cp;
    }
     public function getPays() {
        return $this->pays;
    }

    public function setPays($pays) {
        $this->pays = $pays;
    }
     public function getTel() {
        return $this->tel;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }
     public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
     public function getComLoc() {
        return $this->comLoc;
    }

    public function setComLoc($comLoc) {
        $this->comLoc = $comLoc;
    }
    
        public function __toString() {
        return $this->getPrenom().' '.$this->getNom();    
    }
}
