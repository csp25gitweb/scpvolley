<?php

function getParam($param_name, &$stockage){
    if( isset($_POST[$param_name]) ){
        $stockage = $_POST[$param_name];
        return true;
    }
    else if( isset($_GET[$param_name]) ){
        $stockage = $_GET[$param_name];
        return true;
    }
 
    $stockage = null;
    return false;
}


function checkEmpty($variable){
    if($variable == null || strlen($variable) == 0){
        return true;
    }
    
    return false;
}

?>