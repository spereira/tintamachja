<?php

namespace TINTA\DAO;

use TINTA\Domain\Reservation;

class ReservationDAO extends DAO
{
    /**
     * @var \TINTA\DAO\LocataireDAO
     */
    private $idLocataireDAO;

    public function setIdLocataireDAO(LocataireDAO $idLocataireDAO) {
        $this->idLocataireDAO = $idLocataireDAO;
    }
      private $idVillaDAO;

    public function setIdVillaDAO(VillaDAO $idVillaDAO) {
        $this->idVillaDAO = $idVillaDAO;
    }

     private $idForfaitDAO;

    public function setIdForfaitDAO(ForfaitDAO $idForfaitDAO) {
        $this->idForfaitDAO = $idForfaitDAO;
    }

    

    /**
     * Renvoie la liste de toutes les réservations, triés par numéro
     *
     * @return array La liste de tous les médicaments
     */
    public function findAll() {
        $sql = "select * from reservation order by NUM_RESA";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $reservations = array();
        foreach ($result as $row) {
            $reservationNum = $row['NUM_RESA'];
            $reservations[$reservationNum] = $this->buildDomainObject($row);
        }
        return $reservations;
    }

    /**
     * Renvoie la liste de toutes les réservations appartenant à un locataire
     *
     * @param integer $LocataireId L'identifiant du locataire
     *
     * @return array La liste des réservations
     */
    public function findAllByLocataire($locataireId) {
        $sql = "select * from reservation where NUM_LOC=? order by NUM_RESA";
        $result = $this->getDb()->fetchAll($sql, array($locataireId));
        
        // Convertit les résultats de requête en tableau d'objets du domaine
       $reservations = array();
        foreach ($result as $row) {
            $reservationNum = $row['NUM_RESA'];
            $reservations[$reservationNum] = $this->buildDomainObject($row);
        }
        return $reservations;
    }
    
     /**
     * Renvoie la liste de toutes les réservations appartenant à un locataire
     *
     * @param integer $LocataireId L'identifiant du locataire
     *
     * @return array La liste des réservations
     */
    public function findAllByVilla($villaId) {
        $sql = "select * from reservation where NUM_VILLA=? order by NUM_RESA";
        $result = $this->getDb()->fetchAll($sql, array($villaId));
        
        // Convertit les résultats de requête en tableau d'objets du domaine
       $reservations = array();
        foreach ($result as $row) {
            $reservationNum = $row['NUM_RESA'];
            $reservations[$reservationNum] = $this->buildDomainObject($row);
        }
        return $reservations;
    }


    /**
     * Renvoie une réservation à partir de son numéro
     *
     * @param integer $num L'identifiant de la reservation
     *
     * @return \TINTA\Domain\Reservation|Lève un exception si aucune réservation ne correspond
     */
    public function find($num) {
        $sql = "select * from reservation where NUM_RESA=?";
        $row = $this->getDb()->fetchAssoc($sql, array($num));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucune réservation ne correspond au numéro " . $num);
    }

    /**
     * Crée un objet Reeservation à partir d'une ligne de résultat BD
     *
     * @param array $row La ligne de résultat BD
     *
     * @return \TINTA\Domain\Reservation
     */
    protected function buildDomainObject($row) {
    $reservation = new Reservation();
    $reservation->setNum($row['NUM_RESA']);
    $reservation->setDateA($row['DATE_ARRIVEE']);
    $reservation->setDateD($row['DATE_DEPART']);
    $reservation->setNbNuit($row['NB_NUIT_RESA']);
    $reservation->setNbSemaine($row['NB_SEMAINE_RESA']);
    $reservation->setAnimauxAdmission($row['ANIMAUX_ADMIS_RESA']);
    $reservation->setNbAdulte($row['NB_ADULTE_RESA']);
    $reservation->setNbEnfant($row['NB_ENFANT_RESA']);
    $reservation->setEtat($row['ETAT_RESA']);
    $reservation->setDateResa($row['DATE_RESA']);
    $reservation->setMontant($row['MONTANT_RESA']);
    $reservation->setMontantAnimaux($row['MONTANT_ANIMAUX_RESA']);
    $reservation->setComResa($row['COMM_RESA']);
        

        if (array_key_exists('NUM_LOC', $row)) {
            // Trouve et définit le locataire associée
            $locataireId = $row['NUM_LOC'];
            $locataire = $this->idLocataireDAO->find($locataireId);
            $reservation->setIdLocataire($locataire);
        }
           if (array_key_exists('NUM_VILLA', $row)) {
            // Trouve et définit la villa associée
            $villaId = $row['NUM_VILLA'];
            $villa = $this->idVillaDAO->find($villaId);
            $reservation->setIdVilla($villa);
        }        
          if (array_key_exists('CODE_FOR', $row)) {
            // Trouve et définit le forfait associée
            $forfaitId = $row['CODE_FOR'];
            $forfait = $this->idForfaitDAO->find($forfaitId);
            $reservation->setIdForfait($forfait);
        }
        return $reservation;

    }
    
     /**
     * Saves a reservation into the database.
     *
     * @param \TINTA\Domain\Reservation $reservation The reservation to save
     */
    public function save(Reservation $reservation) {
        $reservationData = array(
            'NUM_LOC' => $reservation->getIdLocataire()->getId(),
                        'NUM_VILLA' => $reservation->getIdVilla()->getId(),
                        'CODE_FOR' => $reservation->getIdForfait()->getId(),
            'DATE_ARRIVEE' => $reservation->getDateA()->format('Y-m-d'),
                        'DATE_DEPART' => $reservation->getDateD()->format('Y-m-d'),
                        'DATE_RESA' => $reservation->getDateResa()->format('Y-m-d'),
            'NB_NUIT_RESA' => $reservation->getNbNuit(),
            'NB_SEMAINE_RESA' => $reservation->getNbSemaine(),
            'NB_ADULTE_RESA' => $reservation->getNbAdulte(),
            'NB_ENFANT_RESA' => $reservation->getNbEnfant(),
            'ETAT_RESA' => $reservation->getEtat(),
            'MONTANT_RESA' => $reservation->getMontant(),
            'ANIMAUX_ADMIS_RESA' => $reservation->getAnimauxAdmission(),
            'MONTANT_ANIMAUX_RESA' => $reservation->getMontantAnimaux(),
            'COMM_RESA' => $reservation->getComResa()
            );
            // The rapportVisite has never been saved : insert it
            $this->getDb()->insert('reservation', $reservationData);
            // Get the id of the newly created rapportVisite and set it on the entity.
            $num = $this->getDb()->lastInsertId();
            $reservation->setNum($num);
        }
	
	
	
	public function delete($id)
	{
		$this->getDb()->delete('reservation', array('id' => $id));
	}


}