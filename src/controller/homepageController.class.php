<?php

class homepageController {
	
	public function __construct() {
		
		$action = 'printIndex';
		if(isset($_GET['action'])) {
			$action = $_GET['action'];
		}
		
		switch($action) {
			case 'printIndex':
				$this->printIndex();
			break;
		
			default:
				// 404
			break;
		}
	}
	
	public function printIndex() {
		require_once('src/model/adherent.class.php');
		require_once('src/model/archive.class.php');
		
		$obj_adherent = adherent::find(1);
		
		echo 'homepage controller...';
	}
}

?>
