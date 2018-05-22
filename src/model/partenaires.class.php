<?php

class partenaires {
    private $id_partenaire;
    private $titre;
    private $description;
    private $lien_logo;
    private $position;
    private $lien;
    
    public function __construct($row = null) {
        if( $row != null ){
            $this->buildObject($row);
        }
        else{
            $this->set_id_partenaire('-1');
        }
    }
    
    public static function newPartenaire($id_partenaire, $titre, $description, $lien_logo, $position, $lien) {
        $obj = new partenaires();
        $obj->set_id_partenaire($id_partenaire);
        $obj->set_titre($titre);
        $obj->set_description($description);
        $obj->set_lien_logo($lien_logo);
        $obj->set_position($position);
        $obj->set_lien($lien);
        return $obj;
    } 
    
    public function get_id_partenaire() {
        return $this->id_partenaire;
    }
    
    public function set_id_partenaire($id_partenaire) {
        $this->id_partenaire = $id_partenaire;
    }
    
    public function get_titre() {
        return $this->titre;
    }
    
    public function set_titre($titre) {
        $this->titre = $titre;
    }
    
    public function get_description() {
        return $this->description;
    }
    
    public function set_description($description) {
        $this->description = $description;
    }
    
    public function get_lien_logo() {
        return $this->lien_logo;
    }
    
    public function set_lien_logo($lien_logo) {
        $this->lien_logo = $lien_logo;
    }
    
    public function get_position() {
        return $this->position;
    }
    
    public function set_position($position) {
        $this->position = $position;
    }
    
    public function get_lien() {
        return $this->lien;
    }
    
    public function set_lien($lien) {
        $this->lien = $lien;
    }
    
    private function buildObject($row) {
        if ( isset($row['id_partenaire']) ) {
            $this->set_id_partenaire($row['id_partenaire']);
        }
        $this->set_titre($row['titre']);
        $this->set_description($row['description']);
        $this->set_lien_logo($row['lien_logo']);
        $this->set_position($row['position']);
        $this->set_lien($row['lien']);
    }
    
    public function save() {
        $bdd = postgresDAO::getInstance();
        $params = array(
            ':titre' => $this->titre,
            ':description' => $this->description,
            ':lien_logo' => $this->lien_logo,
            ':position' => $this->position,
            ':lien' => $this->lien
        );
        $sql = 'INSERT INTO partenaires (titre, description, lien_logo, position, lien)'
                . 'VALUES (:titre, :description, :lien_logo, :position, :lien)';
        $bdd->exec($sql, $params);
        $this->set_id_partenaire($bdd->lastInsertId());
    }
    
    public static function listePositions() {
        $bdd = postgresDAO::getInstance();
        $sql = 'SELECT position FROM partenaires';
        $bdd->exec($sql);
        $results = $bdd->fetchAll(PDO::FETCH_COLUMN);
        $listePosition = array();
        foreach ($results as $i => $j) {
            foreach ($j as $key => $position) {
                if ($key == 'position') {
                    array_push($listePosition, $position);
                }
            }
        }
        return $listePosition;
    }
    
    public static function delete(partenaires $partenaire) {
        $bdd = postgresDAO::getInstance();
        $params = array(':id' => $partenaire->get_id_partenaire());
        $sql = 'DELETE FROM partenaires WHERE id_partenaire = :id';
        $bdd->exec($sql, $params);
    }
    
    public static function find($id_partenaire) {
        $bdd = postgresDAO::getInstance();
        $params = array(':id' => $id_partenaire);
        $sql = 'SELECT id_partenaire, titre, description, lien_logo, position, lien FROM partenaires WHERE id_partenaire = :id';
        $bdd->exec($sql, $params);
        $result = $bdd->fetchAll();
        $partenaire = new partenaires($result[0]);
        return $partenaire;
    }
    
    public static function findAll() {
        $bdd = postgresDAO::getInstance();
        $sql = 'SELECT id_partenaire, titre, description, lien_logo, position, lien FROM partenaires ORDER BY position';
        
        try {
            $bdd->exec($sql);
            $result = $bdd->fetchAll();

            $listPartenaires = array();

            foreach ($result as $pos1 => $row) {
                array_push($listPartenaires, new partenaires($row));
            }

            return $listPartenaires;
        } catch (PDOException $err_pdo) {
            // TODO
        }
    }
    
}

?>
