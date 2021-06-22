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

    if ( !isset($_GET["username"]) ){
        header("Location: homeadmin.php");
        exit;
    }

    require "../allfunctions.php";

    $username = $_GET["username"];
    if ( hapusdatapembeli($username) > 0 ) {
        echo "<script>
            alert('Data Pembeli Berhasil Dihapus');
            document.location.href = 'homeadmin.php#datapembeli';
        </script>";
    } else {
        echo "<script>
            alert('Data Pembeli Gagal Dihapus');
            document.location.href = 'homeadmin.php#datapembeli';
        </script>";
    }


?>