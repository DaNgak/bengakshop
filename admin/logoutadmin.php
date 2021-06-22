<?php 

    session_start();

    if ( !isset($_SESSION["loginadmin"]) ){ 
        header("Location: ../login.php");
        exit;
    }   

    if ( isset($_SESSION["loginpenjual"]) ){
        header("Location: index.php");
        exit;
    }

    if ( isset($_SESSION["loginpembeli"]) ){
        header("Location: index.php");
        exit;
    }

    $_SESSION = [];
    session_unset();
    session_destroy();

    header("Location: ../login.php");
    exit;

?>