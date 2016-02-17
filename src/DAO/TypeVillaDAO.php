<?php

namespace TINTA\DAO;

use TINTA\Domain\TypeVilla;

class TypeVillaDAO extends DAO
{
    /**
     * Renvoie la liste de tous les types de villas, triées par nom
     *
     * @return array La liste de tous les type de villas
     */
    public function findAll() {
        $sql = "select * from type_villa order by LIBELLE_TYVILLA";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $typesvillas = array();
        foreach ($result as $row) {
            $typeVillaId = $row['CODE_TYVILLA'];
            $typesVillas[$typeVillaId] = $this->buildDomainObject($row);
        }
        return $typesVillas;
    }

    /**
     * Renvoie un type de villa à partir de son identifiant
     *
     * @param integer $id L'identifiant du type de villa
     *
     * @return \TINTA\Domain\TypeVilla|Lève une exception si aucun type de villa ne correspond
     */
    public function find($id) {
        $sql = "select * from type_villa where CODE_TYVILLA=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucun type de villa ne correspond à l'identifiant " . $id);
    }

    /**
     * Crée un objet typeVilla à partir d'une ligne de résultat BD
     *
     * @param array $row La ligne de résultat BD
     *
     * @return \TINTA\Domain\TypeVilla
     */
    protected function buildDomainObject($row) {
        $typeVilla = new TypeVilla();
        $typeVilla->setId($row['CODE_TYVILLA']);
        $typeVilla->setLibelle($row['LIBELLE_TYVILLA']);
        $typeVilla->setNbCouchage($row['NB_COUCHAGE']);
        $typeVilla->setComTypeVilla($row['COMM_TYVILLA']);
  
        return $typeVilla;
    }
    
     /**
     * Saves a type of villa into the database.
     *
     * @param \TINTA\Domain\typeVilla $typeVilla The type of villa to save
     */
    public function save(TypeVilla $TypeVilla) {
        $TypeVillaData = array(
            'CODE_TYVILLA' => $typeVilla->getId(),
            'LIBELLE_TYVILLA' => $typeVilla->getLibelle(),
            'NB_COUCHAGE' => $typeVilla->getNbCouchage(),
            'COMM_TYVILLA' => $typeVilla->getComTypeVilla(),
         
            );
            // The type of villa has never been saved : insert it
            $this->getDb()->insert('type_villa', $TypeVillaData);
            // Get the id of the newly created type of villa and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $typeVilla->setId($id);
        }
}