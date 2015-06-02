<?php
function logout(){
    include_once 'include/database.php';
     
    session_start();
   
    $_SESSION = array();
    
     session_unset();
            
    session_destroy();
 
    setcookie('user', '');
	setcookie('id', '');
	setcookie('adm', '');
    
    header('Location: index.php');
    
    exit();
}

?>