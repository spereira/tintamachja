<?php

namespace TINTA\DAO;

use TINTA\Domain\Forfait;

class ForfaitDAO extends DAO
{
    /**
     * Renvoie la liste de tous les forfaits, triées par nom
     *
     * @return array La liste de tous les équipements
     */
  
    public function findAll() {
        $sql = "select * from forfait order by LIBELLE_FOR";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $forfaits = array();
        foreach ($result as $row) {
            $forfaitId = $row['CODE_FOR'];
            $forfaits[$forfaitId] = $this->buildDomainObject($row);
        }
        return $forfaits
            ;
    }

    /**
     * Renvoie un forfait à partir de son identifiant
     *
     * @param integer $id L'identifiant de l'forfait
     *
     * @return \TINTA\Domain\Forfait|Lève une exception si aucun Forfait ne correspond
     */
    public function find($id) {
        $sql = "select * from forfait where CODE_FOR=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucun forfait ne correspond à l'identifiant " . $id);
    }

    /**
     * Crée un objet forfait à partir d'une ligne de résultat BD
     *
     * @param array $row La ligne de résultat BD
     *
     * @return \TINTA\Domain\forfait
     */
    protected function buildDomainObject($row) {
        $forfait = new Forfait();
        $forfait->setId($row['CODE_FOR']);
        $forfait->setLibelle($row['LIBELLE_FOR']);
        $forfait->setDescription($row['DESCRIPTION_FOR']);
        $forfait->setTarif($row['TARIF_FOR']);
        $forfait->setComFor($row['COMM_FOR']);
        return $forfait;
    }
    
     /**
     * Saves a locataire into the database.
     *
     * @param \TINTA\Domain\Locataire $locataire The locataire to save
     */
    public function save(Forfait $forfait) {
        $forfaitData = array(
            'CODE_FOR' => $forfait->getId(),
            'LIBELLE_FOR' => $forfait->getLibelle(),
            'DESCRIPTION_FOR' => $forfait->getDescription(),
            'TARIF_FOR' => $forfait->getTarif(),
            'COMM_FOR' => $forfait->getComFor(),
            );
            // The locataire has never been saved : insert it
            $this->getDb()->insert('forfait', $forfaitData);
            // Get the id of the newly created locataire and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $forfait->setId($id);
        }
}