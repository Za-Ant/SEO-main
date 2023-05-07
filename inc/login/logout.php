<?php
    session_start();
     unset($_SESSION["user_name"]);
     echo 'Boli ste odhlásení';
    //session_destroy(); 
    //header('URL = index.php');
?>