<?php

require_once('src/model/partenaires.class.php');

class homepageController extends AbstractController{
	
    public function __construct() {
        parent::__construct();
        
        $action = null;
        
        getParam('action', $action);
        if(checkEmpty($action)){
            $action = 'printIndex';
        }

        switch($action) {
            case 'printIndex':
                $this->printIndex();
            break;

            default:
                $this->printIndex();
            break;
        }
    }

    public function printIndex() {
        $title = "Accueil" . SITE_TITLE;
        $partenaires = partenaires::findAll();

        $this->smarty->assign('title', $title);
        $this->smarty->assign("partenaires", $partenaires);
        
        $this->smarty->Display('home.home.html');
    }
}

?>
