<?php

class adminContactController{
    
    public function __construct($smarty) {

        $entry = null;
        $title = null;
        
        getParam("entry", $entry);
        
        switch($entry){
            case "printAdd":
                $title = "Ajout contact" . SITE_TITLE;
                
                $requete = "SELECT id_adherent, nom, prenom, date_naissance FROM adherents ORDER BY nom, prenom";
                $db = postgresDAO::getInstance();
                $retour = $db->exec($requete);
                if($retour){
                    $adherents = $db->fetchAll();
                }
                else{
                    $adherents = array('id_adherent'=>'0', 'nom'=>'Erreur', 'prenom'=>'', 'date_naissance'=>'');
                }
                
                $smarty->assign("title", $title);
                $smarty->assign('adherents', $adherents);
                $smarty->Display('admin.addContact.html');
            break;
        
            default:
                echo "404";
            break;
        }
        
    }
    
}

?>

