<?php

namespace TINTA\DAO;

use TINTA\Domain\DateResa;

class DateResaDAO extends DAO
{
    /**
     * Renvoie la liste de toutes les dates, dans l'ordre croissant
     *
     * @return array La liste de toutes les dates
     */
    public function findAll() {
        $sql = "select * from date_reservation";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $dates = array();
        foreach ($result as $row) {
            $dateId = $row['DATE_DEBUT'];
            $dates[$dateId] = $this->buildDomainObject($row);
        }
        return $dates;
    }

    /**
     * Renvoie un locataire à partir de son identifiant
     *
     * @param integer $id L'identifiant du locataire
     *
     * @return \TINTA\Domain\Locataire|Lève une exception si aucun locataire ne correspond
     */
    public function find($id) {
        $sql = "select * from date_reservation where DATE_DEBUT=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucune date ne correspond à l'identifiant " . $id);
    }

    /**
     * Crée un objet date à partir d'une ligne de résultat BD
     *
     * @param array $row La ligne de résultat BD
     *
     * @return \TINTA\Domain\Date
     */
    protected function buildDomainObject($row) {
        $date = new DateResa();
        $date->setDateDeb($row['DATE_DEBUT']);
        $date->setDateFin($row['DATE_FIN']);
        return $date;
    }
    
     /**
     * Saves a locataire into the database.
     *
     * @param \TINTA\Domain\Locataire $locataire The locataire to save
     */
    public function save(DateResa $date) {
        $dateData = array(
            'DATE_DEBUT' => $date->getDateDeb(),
            'DATE_FIN' => $date->getDateFin(),
            );
            // The locataire has never been saved : insert it
            $this->getDb()->insert('date_reservation', $dateData);

        }
}