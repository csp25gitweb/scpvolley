<?php


class adminController extends AbstractController {
	
    public function __construct() {
        parent::__construct();
        
        $action = null;
        $adminSmarty = null;

        getParam("action", $action);

        if( !$this->adminIsConnected() ){
            header('Location: index.php?controller=auth&action=printConn');
        }
        
        //TODO verifier habilitation
        
        $adminSmarty = $this->adminIsConnected() ? '1' : '0';
        $this->smarty->assign('admin', $adminSmarty);

        switch($action){
            case "adherent":
                require_once('src/controller/admin.adherentController.class.php');
                new adminAdherentController($this->smarty);
            break;
        
            case "contact":
                require_once('src/controller/admin.contactController.class.php');
                new adminContactController($this->smarty);
            break;
        
            case "equipe":
                require_once('src/controller/admin.equipeController.class.php');
                new adminEquipeController($this->smarty);
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

    private function adminIsConnected(){
        
        if(isset($_SESSION['is_connected']) && $_SESSION['is_connected'] === true){
            return true;
        }
        
        return false;
    }
    
    
}



?>
