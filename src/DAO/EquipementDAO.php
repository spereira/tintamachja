<?php

namespace TINTA\DAO;

use TINTA\Domain\Equipement;

class EquipementDAO extends DAO
{
    /**
     * Renvoie la liste de tous les equipements, triées par nom
     *
     * @return array La liste de tous les équipements
     */
  
    public function findAll() {
        $sql = "select * from equipement order by LIBELLE_EQUI";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $equipements = array();
        foreach ($result as $row) {
            $equipementId = $row['CODE_EQUI'];
            $equipements[$equipementId] = $this->buildDomainObject($row);
        }
        return $equipements
            ;
    }

    /**
     * Renvoie un equipement à partir de son identifiant
     *
     * @param integer $id L'identifiant de l'equipement
     *
     * @return \TINTA\Domain\Equipement|Lève une exception si aucun equipement ne correspond
     */
    public function find($id) {
        $sql = "select * from equipement where CODE_EQUI=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucun equipement ne correspond à l'identifiant " . $id);
    }

    /**
     * Crée un objet equipement à partir d'une ligne de résultat BD
     *
     * @param array $row La ligne de résultat BD
     *
     * @return \TINTA\Domain\Equipement
     */
    protected function buildDomainObject($row) {
        $equipement = new Equipement();
        $equipement->setId($row['CODE_EQUI']);
        $equipement->setLibelle($row['LIBELLE_EQUI']);
        $equipement->setDescription($row['DESCRIPTION_EQUI']);
        $equipement->setPrix($row['PRIX_EQUI']);
        $equipement->setComEqui($row['COMM_EQUI']);
        return $equipement;
    }
    
     /**
     * Saves a locataire into the database.
     *
     * @param \TINTA\Domain\Locataire $locataire The locataire to save
     */
    public function save(Equipement $equipement) {
        $equipementData = array(
            'CODE_EQUI' => $equipement->getId(),
            'LIBELLE_EQUI' => $equipement->getLibelle(),
            'DESCRIPTION_EQUI' => $equipement->getDescription(),
            'PRIX_EQUI' => $equipement->getPrix(),
            'COMM_EQUI' => $equipement->getComEqui(),
            );
            // The locataire has never been saved : insert it
            $this->getDb()->insert('equipement', $equipementData);
            // Get the id of the newly created locataire and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $equipement->setId($id);
        }
}