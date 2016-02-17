<?php

namespace TINTA\Domain;

class Reservation
{
    /**
     * Numéro.
     *
     * @var integer
     */
    private $num;

    /**
     * Date d'arrivée.
     *
     * @var date
     */
    private $dateA;

    /**
     * Date de départ.
     *
     * @var date
     */
    private $dateD;

    /**
     * Nombre de nuits.
     *
     * @var int
     */
    private $nbNuit;

    /**
     * Nombre de semaine.
     *
     * @var int
     */
    private $nbSemaine;

    /**
     * Nombre d'adulte.
     *
     * @var int
     */
    private $nbAdulte;
    
    /**
     * Nombre d'enfants.
     *
     * @var int
     */
    private $nbEnfant;
    
    /**
     * Etat de la réservation.
     *
     * @var string
     */
    private $etat;
    
    /**
     * Date de la réservation.
     *
     * @var date
     */
    private $dateResa;
    
    /**
     * Montant de la réservation.
     *
     * @var float
     */
    private $montant;
    
        /**
     * Nombre de mois.
     *
     * @var int
     */
    private $animauxAdmission;

    /**
     * Animaux.
     *
     * @var bool
     */
    private $montantAnimaux;
    
    /**
     * Commentaire.
     *
     * @var int
     */
    private $comResa;

    /**
     * Locataire.
     *
     * @var \TINTA\Domaine\Locataire
     */
    private $idLocataire;
    
     /**
     * Villa.
     *
     * @var \TINTA\Domaine\Villa
     */
    private $idVilla;
    
     /**
     * Forfait.
     *
     * @var \TINTA\Domaine\Forfait
     */
    private $idForfait;

    public function getNum() {
        return $this->num;
    }

    public function setNum($num) {
        $this->num = $num;
    }

    public function getDateA() {
        return $this->dateA;
    }

    public function setDateA($dateA) {
        $this->dateA = $dateA;
    }

    public function getDateD() {
        return $this->dateD;
    }

    public function setDateD($dateD) {
        $this->dateD = $dateD;
    }

    public function getNbNuit() {
        return $this->nbNuit;
    }

    public function setNbNuit($nbNuit) {
        $this->nbNuit = $nbNuit;
    }
    public function getNbSemaine() {
        return $this->nbSemaine;
    }

    public function setNbSemaine($nbSemaine) {
        $this->nbSemaine = $nbSemaine;
    }
    public function getAnimauxAdmission() {
        return $this->animauxAdmission;
    }

    public function setAnimauxAdmission($animauxAdmission) {
        $this->animauxAdmission = $animauxAdmission;
    }

    public function getNbAdulte() {
        return $this->nbAdulte;
    }

    public function setNbAdulte($nbAdulte) {
        $this->nbAdulte = $nbAdulte;
    }

    public function getNbEnfant() {
        return $this->nbEnfant;
    }

    public function setNbEnfant($nbEnfant) {
        $this->nbEnfant = $nbEnfant;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }
        public function getDateResa() {
        return $this->dateResa;
    }

    public function setDateResa($dateResa) {
        $this->dateResa = $dateResa;
    }
        public function getMontant() {
        return $this->montant;
    }

    public function setMontant($montant) {
        $this->montant = $montant;
    }
        public function getMontantAnimaux() {
        return $this->montantAnimaux;
    }

    public function setMontantAnimaux($montantAnimaux) {
        $this->montantAnimaux = $montantAnimaux;
    }
         public function getComResa() {
        return $this->comResa;
    }

    public function setComResa($comResa) {
        $this->comResa = $comResa;
    }

    public function getIdLocataire() {
        return $this->idLocataire;
    }

    public function setIdLocataire(Locataire $idLocataire) {
        $this->idLocataire = $idLocataire;
    }
        public function getIdVilla() {
        return $this->idVilla;
    }

    public function setIdVilla(Villa $idVilla) {
        $this->idVilla = $idVilla;
    }
    
            public function getIdForfait() {
        return $this->idForfait;
    }

    public function setIdForfait(Forfait $idForfait) {
        $this->idForfait = $idForfait;
    }
}
