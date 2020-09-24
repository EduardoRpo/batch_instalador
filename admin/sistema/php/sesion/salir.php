<?php 
    session_start();  
    //session_unset();
    session_destroy();
    //setcookie('PHPSESSID', ", time()-3600,'/', ", 0, 0);
    header('location: ../../../../index.php');

?>