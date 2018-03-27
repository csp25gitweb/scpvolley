<?php

abstract class DAO{

    protected $db = null;
    protected $stmt = null;
    
    abstract public function connect($params_bdd);
    
    /*
     * 
     */
    public function exec($query, $params=null) {
        
        if($this->db == null){
            return false;
        }
        
        $this->stmt = $this->db->prepare($query);
        if($this->stmt === false){
            return false;
        }
        
        if($params != null){
            foreach($params as $key => $value){
                $this->stmt->bindValue($key, $value);
            }
        }
        
        return $this->stmt->execute();
    }
    
    /*
     * 
     */
    public function fetchAll(){

       if($this->stmt == null){
           return null;
       }
       
       return $this->stmt->fetchAll();
    }
    
}


?>
