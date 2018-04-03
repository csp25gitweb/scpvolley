<?php

class adherent {
    private $id_adherent;
    private $nom;
    private $prenom;
    private $date_naissance;
    
    const listKnownItems = 'id_adherent, nom, prenom, date_naissance';
    
    public function __construct($row = null) {
        if( $row != null ){
            $this->buildObject($row);
        }
    }
    
    
    /******************************************************/
    
    public function get_id_adherent() {
        return $this->id_adherent;
    }
    public function set_id_adherent($id) {
        $this->id_adherent = $id;
    }
	
    /******************************************************/
    
    public function get_nom() {
        return $this->nom;
    }

    public function set_nom($nom) {
        $this->nom = $nom;
    }

    /******************************************************/
    
    public function get_prenom() {
        return $this->prenom;
    }
    public function set_prenom($prenom) {
        $this->prenom = $prenom;
    }
    
    /******************************************************/

    public function get_date_naissance(){
        return $this->date_naissance;
    }
    public function set_date_naissance($date_naissance){
        $this->date_naissance = $date_naissance;
    }
    
    /******************************************************/
    
    private function buildObject($row) {
        $this->set_id_adherent($row['id_adherent']);
        $this->set_nom($row['nom']);
        $this->set_prenom($row['prenom']);
        $this->set_date_naissance($row['date_naissance']);
    }

    public static function find($param_id){

        $bdd = postgresDAO::getInstance();
        $params = array(
            ':id_adherent' => $param_id
        );
        $query = 'SELECT '.adherent::listKnownItems.' FROM adherents WHERE id_adherent = :id_adherent';

        $bdd->exec($query, $params);
        $result = $bdd->fetchAll();

        if(count($result) == 1){
            return new adherent($result[0]);
        }
        return null;
    }

    public static function findAll(){
        $bdd = postgresDAO::getInstance();
        $query = 'SELECT '.adherent::listKnownItems.' FROM adherents';

        $bdd->exec($query);
        $result = $bdd->fetchAll();

        $arrayAdherent = array();

        foreach ($result as $key=>$value){
            array_push($arrayAdherent, new adherent($value));
        }
        
        return $arrayAdherent;
    }
}

?>
