<?php

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
        $title = "Gestion équipe" . SITE_TITLE;

        $this->smarty->assign('title', $title);
        $this->smarty->Display('home.home.html');
    }
}

?>
