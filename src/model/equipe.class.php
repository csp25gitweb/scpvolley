<?php

class equipe {
    private $id_equipe;
    private $id_categorie;
    private $nom;
    private $points;
    private $victoires;
    private $defaites;
    private $photo;
    
    const listKnownItems = 'id_equipe, id_categorie, nom, points, victoires, defaites, photo';
    
    public function __construct($row = null) {
        if( $row != null ){
            $this->buildObject($row);
        }
        else{
            $this->set_id_equipe('-1');
        }
    }
    
    /***************************************************************/
    
    public function get_id_equipe(){
        return $this->id_equipe;
    }
    
    public function set_id_equipe($id_equipe){
        $this->id_equipe = $id_equipe;
    }
    
    /***************************************************************/
    
    public function get_id_categorie(){
        return $this->id_categorie;
    }
    
    public function set_id_categorie($id_categorie){
        $this->id_categorie = $id_categorie;
    }
    
    /***************************************************************/
    
    public function get_nom(){
        return $this->nom;
    }
    
    public function set_nom($nom){
        $this->nom = $nom;
    }
    
    /***************************************************************/
    
    public function get_points(){
        return $this->points;
    }
    
    public function set_points($points){
        $this->points = $points;
    }
    
    /***************************************************************/
    
    public function get_victoires(){
        return $this->victoires;
    }
    
    public function set_victoires($victoires){
        $this->victoires = $victoires;
    }
    
    /***************************************************************/
    
    public function get_defaites(){
        return $this->defaites;
    }
    
    public function set_defaites($defaites){
        $this->defaites = $defaites;
    }
    
    /***************************************************************/
    
    public function get_photo(){
        return $this->photo;
    }
    
    public function set_photo($photo){
        $this->photo = $photo;
    }

    /******************************************************/
    
    private function buildObject($row) {
        $this->set_id_equipe($row['id_equipe']);
        $this->set_id_categorie($row['id_categorie']);
        $this->set_nom($row['nom']);
        $this->set_points($row['points']);
        $this->set_victoires($row['victoires']);
        $this->set_defaites($row['defaites']);
        $this->set_photo($row['photo']);
    }
    
    
    public function save(){
        $query = null;
        $monArray = array();
    
        $monArray[':id_categorie'] = $this->get_id_categorie();
        $monArray[':nom'] = $this->get_nom();
        $monArray[':points']= $this->get_points();
        $monArray[':victoires'] = $this->get_victoires();
        $monArray[':defaites'] = $this->get_defaites();
        $monArray[':photo'] = $this->get_photo();
        
        if($this->get_id_equipe() != '-1'){
            $monArray[':id_equipe'] = $this->get_id_equipe();
            $query = 'UPDATE equipes SET '
                    . 'id_equipe = :id_equipe, '
                    . 'nom = :nom, '
                    . 'points = :points, '
                    . 'victoires = :victoires, '
                    . 'defaites = :defaites, '
                    . 'photo = :photo '
                    . 'WHERE id_equipe = :id_equipe';
        }
        else{
            $query = "INSERT INTO equipes(id_categorie, nom, points, victoires, defaites, photo)"
            .  " VALUES (:id_categorie, :nom, :points, :victoires, :defaites, :photo)";
        }

        $bdd = postgresDAO::getInstance();
        $retour = $bdd->exec($query, $monArray);
        
        return $retour;
    }

    /******************************************************/
    
    public static function find($param_id){

        $bdd = postgresDAO::getInstance();
        $params = array(
            ':id_equipe' => $param_id
        );
        $query = 'SELECT '.equipe::listKnownItems.' FROM equipes WHERE id_equipe = :id_equipe';

        $bdd->exec($query, $params);
        $result = $bdd->fetchAll();

        if(count($result) == 1){
            return new equipe($result[0]);
        }
        return null;
    }
    
    
    public static function findAll(){
        $bdd = postgresDAO::getInstance();

        $query = 'SELECT '.equipe::listKnownItems.' FROM equipes ORDER BY nom';

        $bdd->exec($query);
        $result = $bdd->fetchAll();

        $arrayEquipe = array();

        foreach ($result as $key=>$value){
            array_push($arrayEquipe, new equipe($value));
        }
        
        return $arrayEquipe;
    }
    
}

?>
