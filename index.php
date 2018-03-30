<?php
require('config.php');

require('libs/DAO/DAO.postgres.class.php');

require('libs/smarty/Smarty.class.php');

$smarty = null;
$content = null;

/*
$smarty = new Smarty();
$content = "Hello";

$smarty->assign("content", $content);
$smarty->Display('index.html');
 */

$array = array(':id_categorie'=>'1');


$bdd = postgresDAO::getInstance($params_bdd);

$bdd->exec("SELECT * FROM categories WHERE id_categorie = :id_categorie ", $array);
$result = $bdd->fetchAll();

print_r($result);

?>

