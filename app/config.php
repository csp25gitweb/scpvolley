<?php

// paramétrage du serveur
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// paramétrage BDD
$params_bdd = array(
    'host' => '10.189.251.9',
    'bdd' => 'scp4',
    'login' => 'scp4',
    'pwd' => 'scp4',
    'port' => '5432',
);

define('PARAMS_BDD', serialize($params_bdd));

define('SITE_TITLE', " - SCP Volley");

?>

