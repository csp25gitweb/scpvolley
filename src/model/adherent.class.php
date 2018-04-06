<?php

class adherent {
    private $id_adherent;
    private $nom;
    private $prenom;
    private $date_naissance;
    private $genre;
    private $no_licence;
    
    const listKnownItems = 'id_adherent, nom, prenom, date_naissance, genre, no_licence';
    
    public function __construct($row = null) {
        if( $row != null ){
            $this->buildObject($row);
        }
        else{
            $this->set_id_adherent('-1');
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

    public function get_date_naissance(){
        return $this->date_naissance;
    }
    public function set_date_naissance($date_naissance){
        $this->date_naissance = $date_naissance;
    }
    
    /******************************************************/
    
     public function get_genre(){
        return $this->genre;
    }
    public function set_genre($genre){
        $this->genre = $genre;
    }
    
    /******************************************************/
    
    public function get_no_licence(){
        return $this->no_licence;
    }
    public function set_no_licence($no_licence){
        $this->no_licence = $no_licence;
    }
    
    /******************************************************/
    
    private function buildObject($row) {
        $this->set_id_adherent($row['id_adherent']);
        $this->set_nom($row['nom']);
        $this->set_prenom($row['prenom']);
        $this->set_date_naissance($row['date_naissance']);
        $this->set_genre($row['genre']);
        $this->set_no_licence($row['no_licence']);
    }

    public function save(){
        $query = null;
        $monArray = array();
    
        $monArray[':login'] = $this->get_nom();
        $monArray[':mdp'] = '123';
        $monArray[':nom'] = $this->get_nom();
        $monArray[':prenom']= $this->get_prenom();
        $monArray[':date_naissance'] = $this->get_date_naissance();
        $monArray[':genre'] = $this->get_genre();
        $monArray[':no_licence'] = $this->get_no_licence();
        
        if($this->get_id_adherent() != '-1'){
            $monArray[':id_adherent'] = $this->get_id_adherent();
            $query = 'UPDATE adherents SET '
                    . 'login = :login, '
                    . 'mdp = :mdp, '
                    . 'nom = :nom, '
                    . 'prenom = :prenom, '
                    . 'date_naissance = :date_naissance, '
                    . 'genre = :genre, '
                    . 'no_licence = :no_licence '
                    . 'WHERE id_adherent = :id_adherent';
        }
        else{
            $query = "INSERT INTO adherents(type_adherent, login, mdp, nom, prenom, no_licence, date_naissance, genre, habilitation, arbitre, entraineur)"
            .  " VALUES ('P', :login, :mdp, :nom, :prenom, :no_licence, :date_naissance, :genre, '1', false, false)";
        }

        $bdd = postgresDAO::getInstance();
        $retour = $bdd->exec($query, $monArray);
        
        return $retour;
    }
    
    
    /******************************************************/
    
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
        $query = 'SELECT '.adherent::listKnownItems.' FROM adherents ORDER BY nom';

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
