<?php

require('../config.php');
require('../libs/DAO/DAO.postgres.class.php');
require('../libs/smarty/Smarty.class.php');


$smarty = null;
$titre = null;

$titre = "SCP Volley - Administration - Ajouter un adhérent";

$smarty = new Smarty();


$smarty->assign("titre", $titre);
$smarty->Display("ajoutAdherent.html");

?>