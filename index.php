<?php

session_start();

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
    break;

    case 'inscription':
    break;

    default:
            // 404
    break;
}

?>

