<?php

namespace TINTA\Domain;

class TypeVilla
{
    /**
     * Identifiant.
     *
     * @var integer
     */
    private $id;

    /**
     *Libelle.
     *
     * @var string
     */
    private $libelle;
    
     /**
     * Nombre de couchages.
     *
     * @var int
     */
    private $nbCouchage;
         /**
     *commentaire
     *
     * @var string
     */
    private $comTypeVilla;

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
    
     public function getNbCouchage() {
        return $this->nbCouchage;
    }

    public function setNbCouchage($nbCouchage) {
        $this->nbCouchage= $nbCouchage;
    }

     public function getComTypeVilla() {
        return $this->comTypeVilla;
    }

    public function setComTypeVilla($comTypeVilla) {
        $this->comVilla = $comTypeVilla;
    }
                public function __toString() {
        return $this->getLibelle();    
    }
}
