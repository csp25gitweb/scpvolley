<?php

require_once('src/model/adherent.class.php');
require_once('src/model/contact.class.php');
require_once('src/model/courriels.class.php');
require_once('src/model/telephones.class.php');

class adminContactController{
    
    public function __construct($smarty) {

        $entry = null;
        $title = null;
        $delid = null;
        
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
        
            case "process":
                $this->processContact($smarty);
            break;
        
            case "delTel":
                getParam("delid", $delid);
                $query = "DELETE FROM telephones WHERE id_telephone = '".$delid."'";
                postgresDAO::getInstance()->exec($query);
            break;
        
            case "delEma":
                getParam("delid", $delid);
                $query = "DELETE FROM courriels WHERE id_courriel = '".$delid."'";
                postgresDAO::getInstance()->exec($query);
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
        
        //Gestion des numéros de telephone
        $arrayTelephones = telephones::findAllForContact($contact->get_id_contact());
        $telNb = count($arrayTelephones);
        
        //Gestion des adresses email
        $arrayCourriels = courriels::findAllForContact($contact->get_id_contact());
        $courrielsNb = count($arrayCourriels);

        //smarty
        $smarty->assign('telNb', $telNb);
        $smarty->assign('telephones', $arrayTelephones);
        
        $smarty->assign('courrielsNb', $courrielsNb);
        $smarty->assign('courriels', $arrayCourriels);
        
        $smarty->assign('contact', $contact);
        $smarty->Display('admin.contact.form.html');
    }
    
    private function processContact($smarty){
        $contact_id_contact = null;
        $contact_nom = null;
        $contact_prenom = null;
        $contact_adresse = null;
        $contact_cp = null;
        $contact_ville = null;
        
        $contact_telNb = null;
        $contact_emailNb = null;

        //Si le formulaire a été posté
        if( isset($_POST['form_post']) ){
            getParam('contact_id_contact', $contact_id_contact);
            getParam('contact_nom'       , $contact_nom);
            getParam('contact_prenom'    , $contact_prenom);
            getParam('contact_adresse'   , $contact_adresse);
            getParam('contact_cp'        , $contact_cp);
            getParam('contact_ville'     , $contact_ville);
            
            getParam('contact_telNb'  , $contact_telNb);
            getParam('contact_emailNb', $contact_emailNb);

            //TODO verifier informations
            
            $contact = new contact();
            $contact->set_id_contact($contact_id_contact);
            $contact->set_nom($contact_nom);
            $contact->set_prenom($contact_prenom);
            $contact->set_adresse($contact_adresse);
            $contact->set_code_postal($contact_cp);
            $contact->set_ville($contact_ville);
            
            $contact->save();
            
            
            //TODO a modifier apres MAJ de la BDD
            for($i = 0 ; $i < $contact_telNb ; $i++){
                if( isset($_POST['contact_tel_'.$i]) ){
                    $telephone = new telephones();
                    if( isset($_POST['contact_id_telephone_'.$i]) ){
                        $telephone->set_id_telephone($_POST['contact_id_telephone_'.$i]);
                    }
                    $telephone->set_id_contact($contact_id_contact);
                    $telephone->set_telephone($_POST['contact_tel_'.$i]);
                    $telephone->save();
                }
            }
            
            for($i = 0 ; $i < $contact_emailNb ; $i++){
                if( isset($_POST['contact_email_'.$i]) ){
                    $courriel = new courriels();
                    if( isset($_POST['contact_id_courriel_'.$i]) ){
                        $courriel->set_id_courriel($_POST['contact_id_courriel_'.$i]);
                    }
                    $courriel->set_id_contact($contact_id_contact);
                    $courriel->set_courriel($_POST['contact_email_'.$i]);
                    $courriel->save();
                }
            }
            
            echo "isok";
        }
    }
    
}

?>

