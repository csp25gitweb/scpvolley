<?php



abstract class AbstractController {
    
    protected $smarty = null;
    
    public function __construct(){
        $this->smarty = new Smarty();
    }
   
}
