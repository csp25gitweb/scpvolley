<?php

abstract class DAO{

    protected static $instance = null;
    
    protected $db = null;
    protected $stmt = null;
    
    protected function __construct() {
        $this->connect(unserialize(PARAMS_BDD));
    }
    
    abstract public static function getInstance();
  
    abstract protected function connect($params_bdd);
    
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
