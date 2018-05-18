<?php

class categories {
    private $id_categorie;
    private $categorie;
    private $description;
    private $age_debut;
    private $age_fin;
    private $duree_entrainement;
    private $duree_match;
    private $tarif;
    
    const listKnownItems = 'id_categorie, categorie, description, age_debut, age_fin, duree_entrainement, duree_match, tarif';
    
    public function __construct($row = null) {
        if( $row != null ){
            $this->buildObject($row);
        }
        else{
            $this->set_id_categorie('-1');
        }
    }
    
    /***************************************************************/
    
    public function get_id_categorie(){
        return $this->id_categorie;
    }
    
    public function set_id_categorie($id_categorie){
        $this->id_categorie = $id_categorie;
    }
    
    /***************************************************************/
    
    public function get_categorie(){
        return $this->categorie;
    }
    
    public function set_categorie($categorie){
        $this->categorie = $categorie;
    }
    
    /***************************************************************/
    
    public function get_description(){
        return $this->description;
    }
    
    public function set_description($description){
        $this->description = $description;
    }
    
    /***************************************************************/
    
    public function get_age_debut(){
        return $this->age_debut;
    }
    
    public function set_age_debut($age_debut){
        $this->age_debut = $age_debut;
    }
    
    /***************************************************************/
    
    public function get_age_fin(){
        return $this->age_fin;
    }
    
    public function set_age_fin($age_fin){
        $this->age_fin = $age_fin;
    }
    
    /***************************************************************/
    
    public function get_duree_entrainement(){
        return $this->duree_entrainement;
    }
    
    public function set_duree_entrainement($duree_entrainement){
        $this->duree_entrainement = $duree_entrainement;
    }
    
    /***************************************************************/
    
    public function get_duree_match(){
        return $this->duree_match;
    }
    
    public function set_duree_match($duree_match){
        $this->duree_match = $duree_match;
    }
    
    /***************************************************************/
    
    public function get_tarif(){
        return $this->tarif;
    }
    
    public function set_tarif($tarif){
        $this->tarif = $tarif;
    }

    /******************************************************/
    
    private function buildObject($row) {
        $this->set_id_categorie($row['id_categorie']);
        $this->set_categorie($row['categorie']);
        $this->set_description($row['description']);
        $this->set_age_debut($row['age_debut']);
        $this->set_age_fin($row['age_fin']);
        $this->set_duree_entrainement($row['duree_entrainement']);
        $this->set_duree_match($row['duree_match']);
        $this->set_duree_entrainement($row['tarif']);
    }
    
    
    public function save(){
        $query = null;
        $monArray = array();
    
        $monArray[':categorie'] = $this->get_categorie();
        $monArray[':description']= $this->get_description();
        $monArray[':age_debut'] = $this->get_age_debut();
        $monArray[':age_fin'] = $this->get_age_fin();
        $monArray[':duree_entrainement'] = $this->get_duree_entrainement();
        $monArray[':duree_match'] = $this->get_duree_match();
        $monArray[':tarif'] = $this->get_tarif();
        
        if($this->get_id_categorie() != '-1'){
            $monArray[':id_categorie'] = $this->get_id_categorie();
            $query = 'UPDATE categories SET '
                    . 'id_categorie = :id_categorie, '
                    . 'categorie = :categorie, '
                    . 'description = :description, '
                    . 'age_debut = :age_debut, '
                    . 'age_fin = :age_fin, '
                    . 'duree_entrainement = :duree_entrainement '
                    . 'duree_entrainement = :duree_entrainement '
                    . 'tarif = :tarif '
                    . 'WHERE id_categorie = :id_categorie';
        }
        else{
            $query = "INSERT INTO categorie(id_categorie, categorie, description, age_debut, age_fin, duree_entrainement, duree_match, tarif)"
            .  " VALUES (:id_categorie, :categorie, :description, :age_debut, :age_fin, :duree_entrainement, :duree_match, :tarif)";
        }

        $bdd = postgresDAO::getInstance();
        $retour = $bdd->exec($query, $monArray);
        
        return $retour;
    }

    /******************************************************/
    
    public static function find($param_id){

        $bdd = postgresDAO::getInstance();
        $params = array(
            ':id_categorie' => $param_id
        );
        $query = 'SELECT '.categories::listKnownItems.' FROM categories WHERE id_categorie = :id_categorie';

        $bdd->exec($query, $params);
        $result = $bdd->fetchAll();

        if(count($result) == 1){
            return new categories($result[0]);
        }
        return null;
    }
    
    public static function findForBirthday($param_naissance, $param_surclassement){

        $naissance = strtotime($param_naissance);
        $age = (int) ((time() - $naissance) / 3600 / 24 / 365.242);
        
        
        $bdd = postgresDAO::getInstance();
        $params = array(
            ':age' => $age
        );
        $query = 'SELECT '.categories::listKnownItems.' FROM categories WHERE age_debut >= :age AND age_fin <= :age';

        $bdd->exec($query, $params);
        $result = $bdd->fetchAll();

        $arrayCategories = array();

        foreach ($result as $key=>$value){
            array_push($arrayCategories, new categories($value));
        }
        
        return $arrayCategories;
    }
    
    public static function findAll(){
        $bdd = postgresDAO::getInstance();

        $query = 'SELECT '.categories::listKnownItems.' FROM categories ORDER BY categorie';

        $bdd->exec($query);
        $result = $bdd->fetchAll();

        $arrayCategories = array();

        foreach ($result as $key=>$value){
            array_push($arrayCategories, new categories($value));
        }
        
        return $arrayCategories;
    }
    
}

?>
