<?php

session_start();
if(isset($_GET['controller']) && $_GET['controller'] == 'disconnect'){
    session_destroy();
    header('Location: index.php');
}

require('app/init.php');

getParam('controller', $s_controller);
if(checkEmpty($s_controller) ){
    $s_controller = 'homepage';
}

switch($s_controller) {
    case 'homepage':
        require_once('src/controller/homepageController.class.php');
        new homepageController();
    break;

    case 'admin':
        require_once('src/controller/adminController.class.php');
        new adminController();
    break;

    case 'auth':
        require_once('src/controller/authController.class.php');
        new authController();
    break;

    case 'agenda':
        require_once('src/controller/agendaController.class.php');
        new agendaController();
    break;

    case 'boutique':
        require_once('src/controller/boutiqueController.class.php');
        new boutiqueController();
    break;

    case 'inscription':
        require_once('src/controller/inscriptionController.class.php');
        new inscriptionController();
    break;

    case 'actualite':
        require_once('src/controller/actualiteController.class.php');
        new actualiteController();
    break;

    default:
            // 404
    break;
}

?>

