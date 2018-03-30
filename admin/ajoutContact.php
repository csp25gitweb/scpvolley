<?php

require('../config.php');
require('../libs/DAO/DAO.postgres.class.php');
require('../libs/smarty/Smarty.class.php');


$smarty = null;
$titre = null;
$requete = null;
$db = null;
$adherents = null;
$retour = null;

$titre = "SCP Volley - Administration - Ajouter un contact";


$requete = "SELECT id_adherent, nom, prenom, date_naissance FROM adherents ORDER BY nom, prenom";
$db = postgresDAO::getInstance($params_bdd);

$retour = $db->exec($requete);
if($retour){
    $adherents = $db->fetchAll();
}
else{
    $adherents = array('id_adherent'=>'0', 'nom'=>'Erreur', 'prenom'=>'', 'date_naissance'=>'');
}

$smarty = new Smarty();

$smarty->assign('titre', $titre);
$smarty->assign('adherents', $adherents);
$smarty->Display('ajoutContact.html');

?>