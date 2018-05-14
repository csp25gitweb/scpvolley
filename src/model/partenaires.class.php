<?php

class partenaires {
    private $id_partenaire;
    private $titre;
    private $description;
    private $lien_logo;
    private $position;
    
    public function __construct($row = null) {
        if( $row != null ){
            $this->buildObject($row);
        }
        else{
            $this->set_id_partenaire('-1');
        }
    }
    
    public static function newPartenaire($titre, $description, $lien_logo, $position) {
        $obj = new partenaires();
        $obj->set_titre($titre);
        $obj->set_description($description);
        $obj->set_lien_logo($lien_logo);
        $obj->set_position($position);
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
    
    private function buildObject($row) {
        if ( isset($id_partenaire) ) {
            $this->set_id_partenaire($row['id_partenaire']);
        }
        $this->set_titre($row['titre']);
        $this->set_description($row['description']);
        $this->set_lien_logo($row['lien_logo']);
        $this->set_position($row['position']);
    }
    
    public function save() {
        $bdd = postgresDAO::getInstance();
        $params = array(
            ':titre' => $this->titre,
            ':description' => $this->description,
            ':lien_logo' => $this->lien_logo,
            ':position' => $this->position
        );
        $query = 'INSERT INTO partenaires (titre, description, lien_logo, position)'
                . 'VALUES (:titre, :description, :lien_logo, :position)';
        $bdd->exec($query, $params);
    }
    
    public static function findAll() {
        $bdd = postgresDAO::getInstance();
        $sql = 'SELECT id_partenaire, titre, description, lien_logo, position FROM partenaires ORDER BY position';
        
        $bdd->exec($sql);
        $result = $bdd->fetchAll(PDO::FETCH_ASSOC);
        
        $listPartenaires = array();
        
        foreach ($result as $pos1 => $row) {
            array_push($listPartenaires, new partenaires($row));
        }
        
        return $listPartenaires;
    }
    
}

?>
