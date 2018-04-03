<?php



class adminAdherentController{
    
    public function __construct($smarty) {
        
        $entry = null;
        $title = null;
        
        getParam("entry", $entry);
        
        switch($entry){
            case "printAdd":
                $title = "Ajout adhérent" . SITE_TITLE;
                
                $smarty->assign("title", $title);
                $smarty->Display('admin.addAdherent.html');
            break;
        
            default:
                echo "404";
            break;
        }
        
    }
    
}


