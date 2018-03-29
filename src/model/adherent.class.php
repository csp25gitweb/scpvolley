<?php

class adherent {
	
	private $id_adherent;
	private $nom;
	private $prenom;
	
	public function getId() {
        return $this->id_adherent;
    }
	
	public function setId($id) {
        $this->id_adherent = $id;
    }
	
	public function getNom() {
		return $this->nom;
	}
	
	public function setNom($nom) {
		$this->nom = $nom;
	}
	
	public function getPrenom() {
		return $this->prenom;
	}
	
	public function setPrenom($prenom) {
		$this->prenom = $prenom;
	}
	
	private function buildObject($row) {
		$this->setId($row['id_adherent']);
		$this->setNom($row['nom']);
		$this->setPrenom($row['prenom']);
	}
	
	public static function find($id) {
		/*$params = array(
			':id_adherent' => $id
		);
		mysqlDAO::getInstance()->exec("SELECT * FROM adherents WHERE id_adherent = :id_adherent ", $params);
		$row = mysqlDAO::getInstance()->fetchAll();
		
		echo 'row = <pre>'.print_r($row, true).'<pre>';*/
		
		$bdd = new mysqlDAO();
		$params = array(
			':id_adherent' => $id
		);
		$bdd->exec('SELECT * FROM adherents WHERE id_adherent = :id_adherent', $params);
		$result = $bdd->fetchAll();

		print_r($result);
		
		/*if($row) {
			$obj = new adherent();
            $obj->buildObject($row);
			return $obj;
		}
        else {
            throw new \Exception("No user for " . $id);
		}*/
	}
	
	public static function findAll() {
		
	}
}

?>
