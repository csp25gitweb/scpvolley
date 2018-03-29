<?php

class archive {
	
	private $id_archive;
	private $titre;
	private $contenu;
	private $id_createur;
	
	private $obj_createur;
	
	public function getId() {
        return $this->id_archive;
    }
	
	public function setId($id) {
        $this->id_archive = $id;
    }
	
	public function getTitre() {
		return $this->titre;
	}
	
	public function setTitre($titre) {
		$this->titre = $titre;
	}
	
	public function getContenu() {
		return $this->contenu;
	}
	
	public function setContenu($contenu) {
		$this->contenu = $contenu;
	}
	
	public function getIdCreateur() {
		return $this->id_createur;
	}
	
	public function setIdCreateur($id_createur) {
		$this->id_createur = $id_createur;
	}
	
	public function getObjCreateur() {
		return $this->obj_createur;
	}
	
	public function setObjCreateur(adherent $createur) {
		$this->obj_createur = $createur;
	}
	
	private function buildObject($row) {
		$this->setId($row['id']);
		$this->setTitre($row['titre']);
		$this->setContenu($row['contenu']);
		
		if(array_key_exists('id_createur', $row)) {
			$this->setIdCreateur($row['id_createur']);
			$obj_createur = adherent::find($row['id_createur']);
			$this->setObjCreateur($obj_createur);
		}
	}
}

?>
