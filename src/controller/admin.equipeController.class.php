<?php

require_once('src/model/equipe.class.php');

class adminEquipeController{
    
    public function __construct($smarty) {
        
        $entry = null;
        $title = null;
        
        getParam("entry", $entry);
        
        switch($entry){
            case "list":
                $title = "Gestion équipe" . SITE_TITLE;
                
                $listeEquipes = equipe::findAll();
                
                $smarty->assign("title", $title);
                $smarty->assign('equipes', $listeEquipes);
                $smarty->Display('admin.equipe.liste.html');
            break;
        
            case "get":
                getParam('id_equipe', $id_equipe);
                $equipe = equipe::find($id_equipe);
                
                $smarty->assign("equipe", $equipe);
                $smarty->Display('admin.equipe.form.html');
            break;
        
            case "printAdd":
                $title = "Ajout équipe" . SITE_TITLE;
                
                $equipe = new equipe();
                
                $smarty->assign("title", $title);
                $smarty->assign("subtitle", 'Ajouter');
                $smarty->assign("equipe", $equipe);
                $smarty->Display('admin.equipe.add.html');
            break;
        
            case "process":
                $this->processEquipe($smarty);
            break;
        
            default:
                echo "404";
            break;
        }
        
    }
    
    private function processEquipe($smarty){
        
    }
    
}


?>