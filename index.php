<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('libs/smarty/Smarty.class.php');

$smarty = null;
$content = null;


$smarty = new Smarty();
$content = "Hello";

$smarty->assign("content", $content);
$smarty->Display('index.html');

?>

