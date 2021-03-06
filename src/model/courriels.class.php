<?php

class courriels {
    private $id_courriel;
    private $id_contact;
    private $courriel;
    
    const listKnownItems = 'id_courriel, id_contact, courriel';
    
    public function __construct($row = null) {
        if( $row != null ){
            $this->buildObject($row);
        }
        else{
            $this->set_id_courriel('-1');
        }
    }
    
    /***************************************************************/
    
    public function get_id_courriel(){
        return $this->id_courriel;
    }
    
    public function set_id_courriel($id_courriel){
        $this->id_courriel = $id_courriel;
    }
    
    /***************************************************************/
    
    public function get_id_contact(){
        return $this->id_contact;
    }
    
    public function set_id_contact($id_contact){
        $this->id_contact = $id_contact;
    }
    
    /***************************************************************/
    
    public function get_courriel(){
        return $this->courriel;
    }
    
    public function set_courriel($courriel){
        $this->courriel = $courriel;
    }

    /******************************************************/
    
    private function buildObject($row) {
        $this->set_id_courriel($row['id_courriel']);
        $this->set_id_contact($row['id_contact']);
        $this->set_courriel($row['courriel']);
    }
    
    
    public function save(){
        $query = null;
        $monArray = array();
    
        $monArray[':id_contact'] = $this->get_id_contact();
        $monArray[':courriel'] = $this->get_courriel();
        
        if($this->get_id_courriel() != '-1'){
            $monArray[':id_courriel'] = $this->get_id_courriel();
            $query = 'UPDATE courriels SET '
                    . 'id_contact = :id_contact, '
                    . 'courriel = :courriel '
                    . 'WHERE id_courriel = :id_courriel';
        }
        else{
            
            $query = "INSERT INTO courriels (id_contact, courriel, ordre) ";
            $query .= "SELECT :id_contact, :courriel, COALESCE(MAX(ordre)+1, '1') FROM courriels WHERE id_contact = :id_contact";
        }

        $bdd = postgresDAO::getInstance();
        $retour = $bdd->exec($query, $monArray);
        
        return $retour;
    }

    /******************************************************/
    
    public static function find($param_id){

        $bdd = postgresDAO::getInstance();
        $params = array(
            ':id_courriel' => $param_id
        );
        $query = 'SELECT '.courriels::listKnownItems.' FROM courriels WHERE id_courriel = :id_courriel';

        $bdd->exec($query, $params);
        $result = $bdd->fetchAll();

        if(count($result) == 1){
            return new courriels($result[0]);
        }
        return null;
    }
    
    
    public static function findAllForContact($param_id){
        $bdd = postgresDAO::getInstance();

        $query = 'SELECT '.  courriels::listKnownItems.' FROM courriels WHERE id_contact = :id_contact ORDER BY ordre';
        $params = array(
            ':id_contact' => $param_id
        );
        
        $bdd->exec($query, $params);
        $result = $bdd->fetchAll();

        $arrayCourriels = array();

        foreach ($result as $key=>$value){
            array_push($arrayCourriels, new courriels($value));
        }
        
        return $arrayCourriels;
    }
    
}

?>
