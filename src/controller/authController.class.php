<?php

class authController extends AbstractController {
    
    public function __construct() {
        parent::__construct();
        
        $action = null;
        getParam("action", $action);
        
        switch($action){
            case 'processConn' :
                $this->authentificate();
            break;
        
            default :
                $this->smarty->assign('title', 'Connexion' . SITE_TITLE);
                $this->smarty->Display("auth.connection.html");
            break;

        }
    }
    
    private function authentificate(){
        
        $login = null;
        $password = null;
        $sha512 = null;
        
        getParam("auth_login", $login);
        getParam("auth_password", $password);
        
        if( checkEmpty($login) || checkEmpty($password) ){
            header('Location: index.php?controller=auth&action=printConn');
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
                $_SESSION["login"] = $login;
                $_SESSION["is_connected"] = true;
            }
        }
    }
    
}



?>