<?php

class telephones {
    private $id_telephone;
    private $id_contact;
    private $telephone;
    
    const listKnownItems = 'id_telephone, id_contact, telephone';
    
    public function __construct($row = null) {
        if( $row != null ){
            $this->buildObject($row);
        }
        else{
            $this->set_id_telephone('-1');
        }
    }
    
    /***************************************************************/
    
    public function get_id_telephone(){
        return $this->id_telephone;
    }
    
    public function set_id_telephone($id_telephone){
        $this->id_telephone = $id_telephone;
    }
    
    /***************************************************************/
    
    public function get_id_contact(){
        return $this->id_contact;
    }
    
    public function set_id_contact($id_contact){
        $this->id_contact = $id_contact;
    }
    
    /***************************************************************/
    
    public function get_telephone(){
        return $this->telephone;
    }
    
    public function set_telephone($telephone){
        $this->telephone = $telephone;
    }

    /******************************************************/
    
    private function buildObject($row) {
        $this->set_id_telephone($row['id_telephone']);
        $this->set_id_contact($row['id_contact']);
        $this->set_telephone($row['telephone']);
    }
    
    
    public function save(){
        $query = null;
        $monArray = array();
    
        $monArray[':id_contact'] = $this->get_id_contact();
        $monArray[':telephone'] = $this->get_telephone();
        
        if($this->get_id_telephone() != '-1'){
            $monArray[':id_telephone'] = $this->get_id_telephone();
            $query = 'UPDATE telephones SET '
                    . 'id_contact = :id_contact, '
                    . 'telephone = :telephone '
                    . 'WHERE id_telephone = :id_telephone';
        }
        else{
            
            $query = "INSERT INTO telephones (id_contact, telephone, ordre) ";
            $query .= "SELECT :id_contact, :telephone, COALESCE(MAX(ordre)+1, '1') FROM telephones WHERE id_contact = :id_contact";
        }

        $bdd = postgresDAO::getInstance();
        $retour = $bdd->exec($query, $monArray);
        
        return $retour;
    }

    /******************************************************/
    
    public static function find($param_id){

        $bdd = postgresDAO::getInstance();
        $params = array(
            ':id_telephone' => $param_id
        );
        $query = 'SELECT '.telephones::listKnownItems.' FROM telephones WHERE id_telephone = :id_telephone';

        $bdd->exec($query, $params);
        $result = $bdd->fetchAll();

        if(count($result) == 1){
            return new telephones($result[0]);
        }
        return null;
    }
    
    
    public static function findAllForContact($param_id){
        $bdd = postgresDAO::getInstance();

        $query = 'SELECT '.  telephones::listKnownItems.' FROM telephones WHERE id_contact = :id_contact ORDER BY ordre';
        $params = array(
            ':id_contact' => $param_id
        );
        
        $bdd->exec($query, $params);
        $result = $bdd->fetchAll();

        $arrayTelephones = array();

        foreach ($result as $key=>$value){
            array_push($arrayTelephones, new telephones($value));
        }
        
        return $arrayTelephones;
    }
    
}

?>
