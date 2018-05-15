<?php

require_once('src/model/partenaires.class.php');

class adminPartenairesControlleur {
    public function __construct($smarty) {
        $entry = null;
        $title = null;
        
        getParam("entry", $entry);
        
        switch ($entry) {
            case 'printList':
                $title = "Liste des partenaires" . SITE_TITLE;
                $smarty->assign("title", $title);
                $listePartenaires = partenaires::findAll();
                $smarty->assign('listePartenaires', $listePartenaires);
                $smarty->Display('admin.partenaire.list.html');
                break;
            case 'printAdd':
                $title = "Ajout partenaire" . SITE_TITLE;
                $smarty->assign("title", $title);
                $smarty->Display('admin.partenaire.add.html');
                break;
            case 'add':
                verifierPartenaire($_POST['titre'], 
                                   $_POST['description'], 
                                   $_POST['lien_logo'],
                                   $_POST['position']);
                break;
            case 'delete':
                $id_partenaire = $_GET['id'];
                deletePartenaires($id_partenaire);
                break;
            default:
                $title = "Gestion des partenaires" . SITE_TITLE;
                $smarty->assign("title", $title);
                $smarty->Display('admin.partenaire.html');
                break;
        }
    }
}

function deletePartenaires($id_partenaires) {
    $partenaire = partenaires::find($id_partenaires);
    partenaires::delete($partenaire);
}

function verifierPartenaire($titre, $description, $lien_logo, $position) {
    $arrayPartenaire = array();
    $arrayPartenaire['titre'] = $_POST['titre'];
    $arrayPartenaire['description'] = $_POST['description'];
    $arrayPartenaire['lien_logo'] = $_POST['lien_logo'];
    $arrayPartenaire['position'] = $_POST['position'];
    $monPartenaire = new partenaires($arrayPartenaire);
    $monPartenaire->save();
}

?>