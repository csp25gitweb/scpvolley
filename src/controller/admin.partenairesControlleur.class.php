<?php

require_once('src/model/partenaires.class.php');

class adminPartenairesControlleur {
    public function __construct($smarty) {
        $entry = null;
        $title = null;
        
        getParam("entry", $entry);
        
        switch ($entry) {
            case 'printAdd':
                // TODO: site_title
                $title = "Ajout partenaire" . "scpvolley";
                $smarty->assign("title", $title);
                $smarty->Display('admin.addPartenaire.html');
                break;
            case 'add':
                $newPartenaire = new partenaires(
                        $_POST['titre'], 
                        $_POST['description'], 
                        $_POST['lien_logo'], 
                        $_POST['position']
                    );
                $newPartenaire->add();
                break;
            default:
                // 404
                echo '404 partenaires';
                break;
        }
    }
}

?>