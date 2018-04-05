<?php

require_once('src/model/adherent.class.php');

class adminContactController{
    
    public function __construct($smarty) {

        $entry = null;
        $title = null;
        
        getParam("entry", $entry);
        
        switch($entry){
            case "printAdd":
                $title = "Ajout contact" . SITE_TITLE;
                
                $listeAdherents = adherent::findAll();
                
                $smarty->assign("title", $title);
                $smarty->assign('adherents', $listeAdherents);
                $smarty->Display('admin.contact.add.html');
            break;
        
            default:
                echo "404";
            break;
        }
        
    }
    
}

?>

