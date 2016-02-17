<?php

namespace TINTA\DAO;

use TINTA\Domain\Villa;

class VillaDAO extends DAO
{
    
    
      /**
     * @var \TINTA\DAO\TypeVillaDAO
     */
    private $typeVillaDAO;

    public function setTypeVillaDAO(TypeVillaDAO $typeVillaDAO) {
        $this->typeVillaDAO = $typeVillaDAO;
    }
        
    
    
    /**
     * Renvoie la liste de toutes les villas, triées par nom
     *
     * @return array La liste de toutes les villas
     */
    public function findAll() {
        $sql = "select * from villa order by NOM_VILLA";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $villas = array();
        foreach ($result as $row) {
            $villaId = $row['NUM_VILLA'];
            $villas[$villaId] = $this->buildDomainObject($row);
        }
        return $villas;
    }
    
        /**
     * Renvoie la liste de toutes les réservations appartenant à un locataire
     *
     * @param integer $LocataireId L'identifiant du locataire
     *
     * @return array La liste des réservations
     */
    public function findAllByLocataire($locataireId) {
        $sql = "select * from villa where NUM_LOC=? order by NUM_VILLA";
        $result = $this->getDb()->fetchAll($sql, array($locataireId));
        
        // Convertit les résultats de requête en tableau d'objets du domaine
       $villas = array();
        foreach ($result as $row) {
            $villaNum = $row['NUM_VILLA'];
            $villas[$villaNum] = $this->buildDomainObject($row);
        }
        return $villas;
    }
    

    /**
     * Renvoie une villa à partir de son identifiant
     *
     * @param integer $id L'identifiant de la villa
     *
     * @return \TINTA\Domain\Villa|Lève une exception si aucune Villa ne correspond
     */
    public function find($id) {
        $sql = "select * from villa where NUM_VILLA=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucune villa ne correspond à l'identifiant " . $id);
    }

    /**
     * Crée un objet villa à partir d'une ligne de résultat BD
     *
     * @param array $row La ligne de résultat BD
     *
     * @return \TINTA\Domain\Villa
     */
    protected function buildDomainObject($row) {
        $villa = new Villa();
        $villa->setId($row['NUM_VILLA']);
        $villa->setNom($row['NOM_VILLA']);
        $villa->setVille($row['VILLE']);
        $villa->setCp($row['CP_VILLA']);
        $villa->setDescription($row['DESCRIPTION_VILLA']);
        $villa->setDescriptionPiece($row['DESCRIPTION_PIECE']);
        $villa->setSurfaceHabitable($row['SURFACE_HABITABLE']);
        $villa->setAnneeConstruction($row['ANNEE_CONSTRUCTION']);
        $villa->setCautionVilla($row['CAUTION_VILLA']);
        $villa->setCautionVelo($row['CAUTION_VELO']);
        $villa->setAnimauxAdmis($row['ANIMAUX']);
        $villa->setComVilla($row['COMM_VILLA']);
        
        
               if (array_key_exists('CODE_TYVILLA', $row)) {
            // Trouve et définit la famille associée
            $typeVillaId = $row['CODE_TYVILLA'];
            $typeVilla = $this->typeVillaDAO->find($typeVillaId);
            $villa->setTypeVilla($typeVilla);
        }
   
        return $villa;
    }
    
 
  
     /**
     * Saves a villa into the database.
     *
     * @param \TINTA\Domain\villa $villa The villa to save
     */
  
    public function save(Villa $villa) {
        $villaData = array(
             'CODE_TYVILLA' => $villa->getTypeVilla()->getId(),
            'NOM_VILLA' => $villa->getNom(),
            'VILLE' => $villa->getVille(),
            'CP_VILLA' => $villa->getCp(),
            'DESCRIPTION_VILLA' => $villa->getDescription(),
            'DESCRIPTION_PIECE' => $villa->getDescriptionPiece(),
            'SURFACE_HABITABLE' => $villa->getSurfaceHabitable(),
            'ANNEE_CONSTRUCTION' => $villa->AnneeConstruction(),
            'CAUTION_VILLA' => $villa->getCautionVilla(),
            'CAUTION_VELO' => $villa->getCautionVelo(),
            'ANIMAUX' => $villa->getAnimauxAdmis(),
            'COMM_VILLA' => $villa->getComVilla()
            );
            // The villa has never been saved : insert it
            $this->getDb()->insert('villa', $villaData);
            // Get the id of the newly created villa and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $villa->setId($id);
        }
}