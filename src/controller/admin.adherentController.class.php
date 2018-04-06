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
        
            case "process":
                $this->processAdherent($smarty);
            break;
        
            default:
                echo "404";
            break;
        }
        
    }
    
    private function processAdherent($smarty){
        $ad_id_adherent = null;
        $ad_nom = null;
        $ad_prenom = null;
        $ad_naissance = null;
        $ad_genre = null;
        $ad_licence = null;

        $ad_login = null;
        $ad_pwd = null;

        //Si le formulaire a été posté
        if( isset($_POST['form_post']) ){
            getParam('ad_id_adherent', $ad_id_adherent);
            getParam('ad_nom'       , $ad_nom);
            getParam('ad_prenom'    , $ad_prenom);
            getParam('ad_naissance' , $ad_naissance);
            getParam('ad_genre'     , $ad_genre);
            getParam('ad_licence'   , $ad_licence);

            if(checkEmpty($ad_nom) || checkEmpty($ad_prenom) || checkEmpty($ad_naissance)
                    || checkEmpty($ad_genre) || checkEmpty($ad_licence) ){
                exit("nok");
            }
            
            $adherent = new adherent();
            $adherent->set_id_adherent($ad_id_adherent);
            $adherent->set_nom($ad_nom);
            $adherent->set_prenom($ad_prenom);
            $adherent->set_date_naissance($ad_naissance);
            $adherent->set_genre($ad_genre);
            $adherent->set_no_licence($ad_licence);
            
            $adherent->save();
                $smarty->assign('adherent', $adherent);
                $smarty->Display('admin.adherent.recap.html');

        }
    }
    
}
