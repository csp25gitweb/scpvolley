<?php


class adminController extends AbstractController {
	
    public function __construct() {
        parent::__construct();
        
        $action = null;

        getParam("action", $action);

        switch($action){
            case "adherent":
                require_once('src/controller/admin.adherentController.class.php');
                new adminAdherentController($this->smarty);
            break;
        
            case "contact":
                require_once('src/controller/admin.contactController.class.php');
                new adminContactController($this->smarty);
            break;
        
            case "partenaires":
                require_once('src/controller/admin.partenairesControlleur.class.php');
                new adminPartenairesControlleur($this->smarty);
            break;
        
            default:
                //404
                echo "404";
                break;
        }
    }
}



?>
