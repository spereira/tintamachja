<?php

namespace TINTA\Domain;

class Villa
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
     * Ville.
     *
     * @var string
     */
    private $ville;
    
     /**
     * Cp.
     *
     * @var string
     */
    private $cp;
    
     /**
     * Description.
     *
     * @var string
     */
    private $description;
    
     /**
     * Description Piece.
     *
     * @var string
     */
    private $descriptionPiece;
    
     /**
     * Surface habitable.
     *
     * @var int
     */
    private $surfaceHabitable;
    
     /**
     * Annee de construction.
     *
     * @var string
     */
    private $anneeConstruction;
         /**
     * CautionVilla.
     *
     * @var decimal
     */
    private $cautionVilla;
         /**
     * Caution vélo.
     *
     * @var decimal
     */
    private $cautionVelo;
         /**
     * Animaux.
     *
     * @var boolean
     */
    private $animauxAdmis;
         /**
     * commentaire
     *
     * @var string
     */
    private $comVilla;
    
       /**
     * TypeVilla.
     *
     * @var \TINTA\Domaine\TypeVilla
     */
    private $typeVilla;

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
    
     public function getVille() {
        return $this->ville;
    }

    public function setVille($ville) {
        $this->ville= $ville;
    }
     public function getCp() {
        return $this->cp;
    }

    public function setCp($cp) {
        $this->cp = $cp;
    }

     public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
        public function getDescriptionPiece() {
        return $this->descriptionPiece;
    }

    public function setDescriptionPiece($descriptionPiece) {
        $this->descriptionPiece = $descriptionPiece;
    }
     public function getSurfaceHabitable() {
        return $this->surfaceHabitable;
    }

    public function setSurfaceHabitable($surfaceHabitable) {
        $this->surfaceHabitable = $surfaceHabitable;
    }
     public function getAnneeConstruction() {
        return $this->anneeConstruction;
    }

    public function setAnneeConstruction($anneeConstruction) {
        $this->anneeConstruction = $anneeConstruction;
    }
         public function getCautionVilla() {
        return $this->cautionVilla;
    }
     public function setCautionVilla($cautionVilla) {
        $this->cautionVilla = $cautionVilla;
    }
            public function getCautionVelo() {
        return $this->cautionVelo;
    }

    public function setCautionVelo($cautionVelo) {
        $this->cautionVelo = $cautionVelo;
    }
        public function getAnimauxAdmis() {
        return $this->animauxAdmis;
    }

    public function setAnimauxAdmis($animauxAdmis) {
        $this->animauxAdmis = $animauxAdmis;
    }
     public function getComVilla() {
        return $this->comVilla;
    }

    public function setComVilla($comVilla) {
        $this->comVilla = $comVilla;
    }
        public function getTypeVilla() {
        return $this->typeVilla;
    }

    public function setTypeVilla(TypeVilla $typeVilla) {
        $this->typeVilla = $typeVilla;
    }
            public function __toString() {
        return $this->getNom();    
    }
}
