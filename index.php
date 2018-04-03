<?php
require('app/init.php');


$smarty = null;
$content = null;

/*
$smarty = new Smarty();
$content = "Hello";

$smarty->assign("content", $content);
$smarty->Display('index.html');
 */

$array = array(':id_categorie'=>'1');


$bdd = postgresDAO::getInstance();

$bdd->exec("SELECT * FROM categories WHERE id_categorie = :id_categorie ", $array);
$result = $bdd->fetchAll();

print_r($result);

?>

