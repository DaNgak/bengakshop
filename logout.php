<?php 

    session_start();
    // if ( !isset($_SESSION["loginpenjual"]) ){ 
    //     header("Location: login.php");
    //     exit;
    // }

    // if ( !isset($_SESSION["loginpembeli"]) ){ 
    //     header("Location: login.php");
    //     exit;
    // }

    if ( !isset($_SESSION["username"]) ){ 
        header("Location: login.php");
        exit;
    }

    if ( isset($_SESSION["loginadmin"]) ){ 
        header("Location: admin/homeadmin.php");
        exit;
    }

    $_SESSION = [];
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;

?>