<?php

require_once('src/model/adherent.class.php');

class adminAdherentController{
    
    public function __construct($smarty) {
        
        $entry = null;
        $title = null;
        
        getParam("entry", $entry);
        
        switch($entry){
            case "list":
                $title = "Gestion adhérent" . SITE_TITLE;
                
                $listeAdherents = adherent::findAll();
                
                $smarty->assign("title", $title);
                $smarty->assign('adherents', $listeAdherents);
                $smarty->Display('admin.adherent.liste.html');
            break;
        
            case "get":
                getParam('id_adherent', $id_adherent);
                $adherent = adherent::find($id_adherent);
                
                $smarty->assign("adherent", $adherent);
                $smarty->Display('admin.adherent.form.html');
            break;
        
            case "printAdd":
                $title = "Ajout adhérent" . SITE_TITLE;
                
                $adherent = new adherent();
                
                $smarty->assign("title", $title);
                $smarty->assign("subtitle", 'Ajouter');
                $smarty->assign("adherent", $adherent);
                $smarty->Display('admin.adherent.add.html');
            break;
        
            default:
                echo "404";
            break;
        }
        
    }
    
}


