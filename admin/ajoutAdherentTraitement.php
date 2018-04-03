<?php

require_once('../app/init.php');


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
    
    if(checkEmpty($ad_nom) || checkEmpty($ad_prenom) || checkEmpty($ad_naissance)
            || checkEmpty($ad_genre) || checkEmpty($ad_licence) ){
        exit("nok");
    }
    
    
    //traitement avant inscription
    $ad_nom = strtoupper($ad_nom);
    $ad_prenom = ucfirst($ad_prenom);
    
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

    $bdd = postgresDAO::getInstance();
    $retour = $bdd->exec($requete, $monArray);
    
    if($retour === true){
        $contenu = "<fieldset>"
                . "<legend>Récapitulatif</legend>"
                . "<p>Adhérent inscrit avec succès</p>";
    }
    else{
        $contenu = "<fieldset>"
                . "<legend>Récapitulatif</legend>"
                . "<p>Erreur lors du traitement</p>";
    }
    
    //TODO gérer l'affichage avec bootstrap pour aligner les informations
    //TODO affichage de la date de naissance
    $contenu .= "<h4>Rappel des informations</h4>"
            . "<p>Identifiant : " . $login
            . "<br/>Nom : " . $ad_nom
            . "<br/>Prénom : " . $ad_prenom
            . "<br/>Date de naissance : " . $ad_naissance
            . "<br/>Genre : " . $ad_genre
            . "<br/>Numéro de licence : " . $ad_licence
            . "</fieldset>";
    
    echo $contenu;
}
else{
    echo "nok";
}