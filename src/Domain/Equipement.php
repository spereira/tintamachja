<?php

namespace TINTA\Domain;

class Equipement
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
    private $libelle;
    
     /**
     * Prenom.
     *
     * @var string
     */
    private $description;
    
     /**
     * Rue.
     *
     * @var string
     */
    private $prix;
    
     /**
     * Ville.
     *
     * @var string
     */
    private $comEqui;
    
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }
    
     public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
     public function getPrix() {
        return $this->prix;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

     public function getComEqui() {
        return $this->comEqui;
    }

    public function setComEqui($comEqui) {
        $this->comEqui = $comEqui;
    }
    
        public function __toString() {
        return $this->getPrenom().' '.$this->getNom();    
    }
}
