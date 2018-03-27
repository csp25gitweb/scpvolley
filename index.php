<?php

require('config.php');

require('libs/smarty/Smarty.class.php');

$smarty = null;
$content = null;


$smarty = new Smarty();
$content = "Hello";

$smarty->assign("content", $content);
$smarty->Display('index.html');

?>

