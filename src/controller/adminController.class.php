<?php


class adminController extends AbstractController {
	
    public function __construct() {
        parent::__construct();
        
        $action = null;
        $adminSmarty = null;

        getParam("action", $action);
        
        $adminSmarty = $this->adminIsConnected() ? '1' : '0';
        $this->smarty->assign('admin', $adminSmarty);

        switch($action){
            case "printConn":
                $this->smarty->assign('title', 'Connexion admin' . SITE_TITLE);
                $this->smarty->Display("admin.connection.html");
            break;
        
            case "processConn":
                $this->authentificate();
            break;
            
            case "adherent":
                if( $this->adminIsConnected() ){
                    require_once('src/controller/admin.adherentController.class.php');
                    new adminAdherentController($this->smarty);
                }
                else{
                    header('Location: index.php?controller=admin&action=printConn');
                }
            break;
        
            case "contact":
                if( $this->adminIsConnected() ){
                    require_once('src/controller/admin.contactController.class.php');
                    new adminContactController($this->smarty);
                }
                else{
                    header('Location: index.php?controller=admin&action=printConn');
                }
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
    
    
    private function authentificate(){
        
        $login = null;
        $password = null;
        $sha512 = null;
        
        getParam("admin_login", $login);
        getParam("admin_password", $password);
        
        if( checkEmpty($login) || checkEmpty($password) ){
            header('Location: index.php?controller=admin&action=printConn');
        }
        else{
            $sha512 = hash('sha512', $password);
            
            $query = 'SELECT id_adherent, habilitation FROM adherents WHERE login = :login AND mdp = :mdp';
            $params = array(':login' => $login, ':mdp' => $sha512);
            
            $bdd = postgresDAO::getInstance();
            $bdd->exec($query, $params);
            
            $result = $bdd->fetchAll();
            
            //TODO a changer
            if($result != null){
                $_SESSION["admin_login"] = $login;
                $_SESSION["admin_is_connected"] = true;
            }
        }
    }
    
    private function adminIsConnected(){
        
        if(isset($_SESSION['admin_is_connected']) && $_SESSION['admin_is_connected'] === true){
            return true;
        }
        
        return false;
    }
    
    
}



?>
