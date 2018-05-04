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
        
            case "process":
                $this->processContact($smarty);
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
                    $tel = $_POST['contact_tel_'.$i];
                    $query = "INSERT INTO telephones (id_contact, telephone) VALUES ('".$contact_id_contact."', '".$tel."')";
                    echo $query;
                    $bdd = postgresDAO::getInstance();
                    $retour = $bdd->exec($query);
                }
            }
            
            for($i = 0 ; $i < $contact_emailNb ; $i++){
                if( isset($_POST['contact_email_'.$i]) ){
                    $courriel = $_POST['contact_email_'.$i];
                    $query = "INSERT INTO courriels (id_contact, courriel) VALUES ('".$contact_id_contact."', '".$courriel."')";
                    
                    $bdd = postgresDAO::getInstance();
                    $retour = $bdd->exec($query);
                }
            }
            
            
            $smarty->assign('contact', $contact);
            $smarty->Display('admin.contact.recap.html');
        }
    }
    
}

?>

