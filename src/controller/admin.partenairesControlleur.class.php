<?php

require_once('src/model/partenaires.class.php');

class adminPartenairesControlleur {
    public function __construct($smarty) {
        $entry = null;
        $title = null;
        
        getParam("entry", $entry);
        
        switch ($entry) {
            case 'add':
                verifierPartenaire($_POST['titre'], 
                                   $_POST['description'], 
                                   $_POST['lien_logo'],
                                   $_POST['position'],
                                   $_POST['lien']
                        );
                header('Location: index.php?controller=admin&action=partenaires&entry=printAdd');
                break;
            case 'printAdd':
                $title = "Ajout partenaire" . SITE_TITLE;
                $smarty->assign("title", $title);
                $smarty->Display('admin.partenaire.add.html');
                break;
            case 'delete':
                $id_partenaire = $_GET['id'];
                deletePartenaires($id_partenaire);
                header('Location: index.php?controller=admin&action=partenaires&entry=printList');
                break;
            case 'printList':
                $title = "Liste des partenaires" . SITE_TITLE;
                $smarty->assign("title", $title);
                $listePartenaires = partenaires::findAll();
                $smarty->assign('listePartenaires', $listePartenaires);
                $smarty->Display('admin.partenaire.list.html');
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

function verifierPartenaire($titre, $description, $lien_logo, $position, $lien) {
    $listePositions = partenaires::listePositions();
    if (in_array($position, $listePositions)) {
        // PAS BON
    } else {
        $arrayPartenaire = array();
        $arrayPartenaire['titre'] = $titre;
        $arrayPartenaire['description'] = $description;
        $arrayPartenaire['lien_logo'] = $lien_logo;
        $arrayPartenaire['position'] = $position;
        $arrayPartenaire['lien'] = $lien;
        $monPartenaire = new partenaires($arrayPartenaire);
        print_r($monPartenaire->get_lien());
        $monPartenaire->save();
    }
}

?>