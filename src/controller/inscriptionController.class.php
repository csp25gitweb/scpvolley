<?php

class inscriptionController extends AbstractController {
	
    public function __construct() {
        parent::__construct();
        
        $action = null;
        getParam("action", $action);
        
        switch($action){
            default:
                $this->smarty->Display('home.inscription.html');
            break;
        }
    }
}