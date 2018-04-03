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
                    // 404
            break;
        }
    }

    public function printIndex() {
        echo 'homepage controller...';
    }
}

?>
