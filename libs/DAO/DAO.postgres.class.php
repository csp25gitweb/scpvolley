<?php

require('DAO.class.php');

class postgresDAO extends DAO{

    /*
     * 
     */
    public function connect($params_bdd) {
        
        $conn = 'pgsql:host='.$params_bdd['host'];
        $conn .= ';port='.$params_bdd['port'];
        $conn .= ';dbname='.$params_bdd['bdd'];
        $conn .= ';user='.$params_bdd['login'];
        $conn .= ';password='.$params_bdd['pwd'];

        try{
            $this->db = new PDO($conn);
        }
        catch (PDOException $e){
            //TODO gestion erreur

            return false;
        }
        return true;
    }

    
    
    
    
}


?>
