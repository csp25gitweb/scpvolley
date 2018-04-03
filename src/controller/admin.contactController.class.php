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
                //construction de l'array pour smarty
                $arrayAdherents= array();
                
                foreach($listeAdherents as $key=>$value){
                    $adherent = array(
                        'id_adherent'   =>$value->get_id_adherent(),
                        'nom'           =>$value->get_nom(),
                        'prenom'        =>$value->get_prenom(),
                        'date_naissance'=>$value->get_date_naissance()
                        );
                    array_push($arrayAdherents, $adherent);
                }
                
                $smarty->assign("title", $title);
                $smarty->assign('adherents', $arrayAdherents);
                $smarty->Display('admin.addContact.html');
            break;
        
            default:
                echo "404";
            break;
        }
        
    }
    
}

?>

