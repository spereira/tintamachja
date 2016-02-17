<?php

namespace TINTA\DAO;

use TINTA\Domain\Locataire;

class LocataireDAO extends DAO
{
    /**
     * Renvoie la liste de tous les locataires, triées par nom
     *
     * @return array La liste de tous les locataires
     */
  
    public function findAll() {
        $sql = "select * from locataire order by NOM_LOC";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $locataires = array();
        foreach ($result as $row) {
            $locataireId = $row['NUM_LOC'];
            $locataires[$locataireId] = $this->buildDomainObject($row);
        }
        return $locataires;
    }

    /**
     * Renvoie un locataire à partir de son identifiant
     *
     * @param integer $id L'identifiant du locataire
     *
     * @return \TINTA\Domain\Locataire|Lève une exception si aucun locataire ne correspond
     */
    public function find($id) {
        $sql = "select * from locataire where NUM_LOC=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucun locataire ne correspond à l'identifiant " . $id);
    }

    /**
     * Crée un objet Locataire à partir d'une ligne de résultat BD
     *
     * @param array $row La ligne de résultat BD
     *
     * @return \TINTA\Domain\Locataire
     */
    protected function buildDomainObject($row) {
        $locataire = new Locataire();
        $locataire->setId($row['NUM_LOC']);
        $locataire->setNom($row['NOM_LOC']);
        $locataire->setPrenom($row['PRENOM_LOC']);
        $locataire->setRue($row['RUE_LOC']);
        $locataire->setVille($row['VILLE_LOC']);
        $locataire->setCp($row['CP_LOC']);
        $locataire->setPays($row['PAYS_LOC']);
        $locataire->setTel($row['TEL_LOC']);
        $locataire->setEmail($row['EMAIL_LOC']);
        $locataire->setComLoc($row['COMM_LOC']);
        return $locataire;
    }
    
     /**
     * Saves a locataire into the database.
     *
     * @param \TINTA\Domain\Locataire $locataire The locataire to save
     */
    public function save(Locataire $locataire) {
        $locataireData = array(
            'NOM_LOC' => $locataire->getNom(),
            'PRENOM_LOC' => $locataire->getPrenom(),
            'RUE_LOC' => $locataire->getRue(),
            'VILLE_LOC' => $locataire->getVille(),
            'CP_LOC' => $locataire->getCp(),
            'PAYS_LOC' => $locataire->getPays(),
            'TEL_LOC' => $locataire->getTel(),
            'EMAIL_LOC' => $locataire->getEmail(),
            'COMM_LOC' => $locataire->getComLoc()
            );
            // The locataire has never been saved : insert it
            $this->getDb()->insert('Locataire', $locataireData);
            // Get the id of the newly created locataire and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $locataire->setId($id);
        }
}