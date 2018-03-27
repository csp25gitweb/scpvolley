<?php

abstract class DAO{

    protected $db = null;
    protected $stmt = null;
    
    abstract public function connect($params_bdd);
    
    abstract public function exec($query, $params=null);
    
    abstract public function fetchAll();
    
}


?>
