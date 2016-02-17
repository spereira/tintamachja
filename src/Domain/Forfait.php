<?php

namespace TINTA\Domain;

class Forfait
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
    private $tarif;
    
     /**
     * Ville.
     *
     * @var string
     */
    private $comFor;
    
    
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
     public function getTarif() {
        return $this->tarif;
    }

    public function setTarif($tarif) {
        $this->tarif = $tarif;
    }

     public function getComFor() {
        return $this->comFor;
    }

    public function setComFor($comFor) {
        $this->ccomFor = $comFor;
    }
    
        public function __toString() {
        return $this->getLibelle();    
    }
}
