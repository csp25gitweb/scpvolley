<?php

require_once('../config.php');
require_once('../libs/DAO/DAO.postgres.class.php');
require_once('../libs/smarty/Smarty.class.php');

require_once('../libs/utils.functions.php');

$retour = null;
$contenu = null;

$ad_nom = null;
$ad_prenom = null;
$ad_naissance = null;
$ad_genre = null;
$ad_licence = null;

$ad_login = null;
$ad_pwd = null;


//Si le formulaire a été posté
if( isset($_POST['form_post']) ){
    
    getParam('ad_nom'       , $ad_nom);
    getParam('ad_prenom'    , $ad_prenom);
    getParam('ad_naissance' , $ad_naissance);
    getParam('ad_genre'     , $ad_genre);
    getParam('ad_licence'   , $ad_licence);
    
    $login = $ad_nom .'.'. $ad_prenom;
    $mdp = "mdp";
    
    $monArray = array(
        ':login'            => $login,
        ':mdp'              => $mdp,
        ':nom'              => $ad_nom,
        ':prenom'           => $ad_prenom,
        ':date_naissance'   => $ad_naissance,
        ':genre'            => $ad_genre,
        ':no_licence'       => $ad_licence);
    
    $requete = "INSERT INTO adherents(type_adherent, login, mdp, nom, prenom, no_licence, date_naissance, genre, habilitation, arbitre, entraineur)"
            .  " VALUES ('P', :login, :mdp, :nom, :prenom, :no_licence, :date_naissance, :genre, '1', false, false)";

    $bdd = postgresDAO::getInstance($params_bdd);
    $retour = $bdd->exec($requete, $monArray);
    
    if($retour === true){
        $contenu = "<p>Adhérent inscrit avec succès</p>";
    }
    else{
        $contenu = "<p>Erreur lors du traitement</p>";
    }
    
    //TODO gérer l'affichage avec bootstrap pour aligner les informations
    //TODO affichage de la date de naissance
    $contenu .= "<h4>Rappel des informations</h4>"
            . "<p>Identifiant : " . $login
            . "<br/>Nom : " . $ad_nom
            . "<br/>Prénom : " . $ad_prenom
            . "<br/>Date de naissance : " . $ad_naissance
            . "<br/>Genre : " . $ad_genre
            . "<br/>Numéro de licence : " . $ad_licence;
    
    echo $contenu;
}
else{
    echo "nok";
}