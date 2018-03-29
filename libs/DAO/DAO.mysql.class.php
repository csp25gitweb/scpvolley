<?php

require_once('DAO.class.php');

class mysqlDAO extends DAO {
	private static $instance = null;
	
	public function __construct() {
		$this->connect(unserialize(PARAMS_BDD));
	}
	
	public function connect($params_bdd) {
        
        $conn = 'mysql:host='.$params_bdd['host'];
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
	
	public static function getInstance() {
		if(is_null(self::$instance)) {
			self::$instance = new mysqlDAO();
		}
		return self::$instance;
	}
}

?>
