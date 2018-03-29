<?php

// paramétrage BDD
$params_bdd = array(
    'host' => '127.0.0.1',
    'bdd' => 'scpvolley',
    'login' => 'root',
    'pwd' => 'boosted',
    'port' => '3306',
);

define('PARAMS_BDD', serialize($params_bdd));

?>

