<?php

class contact{
    
    private $id_contact;
    private $nom;
    private $prenom;
    
    
    const listKnownItems = 'id_contact, nom, prenom';
    
    public function __construct($row = null) {
        if( $row != null ){
            $this->buildObject($row);
        }
        else{
            $this->set_id_contact('-1');
        }
    }
    
    
    /******************************************************/
    
    public function get_id_contact() {
        return $this->id_contact;
    }
    public function set_id_contact($id) {
        $this->id_contact = $id;
    }
	
    /******************************************************/
    
    public function get_nom() {
        return $this->nom;
    }

    public function set_nom($nom) {
        $this->nom = strtoupper($nom);
    }

    /******************************************************/
    
    public function get_prenom() {
        return $this->prenom;
    }
    public function set_prenom($prenom) {
        $this->prenom = $prenom;
    }
    
    /******************************************************/
    
    private function buildObject($row) {
        $this->set_id_contact($row['id_contact']);
        $this->set_nom($row['nom']);
        $this->set_prenom($row['prenom']);
    }
    
    
    /******************************************************/
    
    public static function find($param_id){

        $bdd = postgresDAO::getInstance();
        $params = array(
            ':id_contact' => $param_id
        );
        $query = 'SELECT '.contact::listKnownItems.' FROM contacts WHERE id_contact = :id_contact';

        $bdd->exec($query, $params);
        $result = $bdd->fetchAll();

        if(count($result) == 1){
            return new contact($result[0]);
        }
        return null;
    }
    
    
    public static function findAllForAdherent($id_adherent){
        $bdd = postgresDAO::getInstance();
        $params = array(
            ':id_adherent' => $id_adherent
        );
        $query = 'SELECT '.contact::listKnownItems.' FROM contacts WHERE id_adherent = :id_adherent ORDER BY nom';

        $bdd->exec($query, $params);
        $result = $bdd->fetchAll();

        $arrayContact = array();

        foreach ($result as $key=>$value){
            array_push($arrayContact, new contact($value));
        }
        
        return $arrayContact;
    }
}