<?php

class partenaires {
    private $id_partenaire;
    private $titre;
    private $description;
    private $lien_logo;
    private $position;
    
    public function __construct($titre, $description, $lien_logo, $position) {
        $this->titre = $titre;
        $this->description = $description;
        $this->lien_logo = $lien_logo;
        $this->position = $position;
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
        $this->set_id_partenaire($row['id_partenaire']);
        $this->set_titre($row['titre']);
        $this->set_description($row['description']);
        $this->set_lien_logo($row['lien_logo']);
        $this->set_position($row['position']);
    }
    
    public function add() {
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
        $result = $bdd->fetchAll();
        if ($result != NULL) {
            $this->id_partenaire = $result;
        } else {
            error_log("partenaires add: request failed");
        }
        
    }
    
}

?>
