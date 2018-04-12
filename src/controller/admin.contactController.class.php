<?php

require_once('src/model/adherent.class.php');
require_once('src/model/contact.class.php');

class adminContactController{
    
    public function __construct($smarty) {

        $entry = null;
        $title = null;
        
        getParam("entry", $entry);
        
        switch($entry){
            case "list":
                $title = "Gestion contact" . SITE_TITLE;
                
                $listeAdherents = adherent::findAll();
                
                $smarty->assign("title", $title);
                $smarty->assign('adherents', $listeAdherents);
                $smarty->Display('admin.contact.liste.html');
            break;
        
            case 'getListeContacts':
                $this->getListeContacts($smarty);
            break;
        
            case 'getContact':
                $this->getContact($smarty);
            break;
        
            default:
                echo "404";
            break;
        }
        
    }
    
    private function getListeContacts($smarty){
        $id_adherent = null;
        
        getParam('id_adherent', $id_adherent);
        
        $contacts = contact::findAllForAdherent($id_adherent);
        
        $smarty->assign("contact", $contacts);
        $smarty->Display("admin.contact.listeContacts.html");

    }
    
    private function getContact($smarty){
        
        $id_contact = null;
        $contact = null;
        
        getParam('id_contact', $id_contact);
        
        if( !checkEmpty($id_contact) && $id_contact != -1){
            $contact = contact::find($id_contact);
        }
        else{
            $contact = new contact();
        }
        
        $smarty->assign('contact', $contact);
        $smarty->Display('admin.contact.form.html');
    }
    
}

?>

