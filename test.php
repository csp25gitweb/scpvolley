<?php

require('app/init.php');

$s_controller = 'homepage';
if(isset($_GET['controller'])) {
	$s_controller = $_GET['controller'];
}

$controller = null;

switch($s_controller) {
	case 'homepage':
		require_once('src/controller/homepageController.class.php');
		$controller = new homepageController();
	break;

	case 'archives':
	break;

	case 'agenda':
	break;

	case 'inscription':
	break;

	default:
		// 404
	break;
}

?>

