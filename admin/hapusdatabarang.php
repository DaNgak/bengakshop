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

    if ( !isset($_GET["id_barang"]) ){
        header("Location: homeadmin.php");
        exit;
    }

    require "../allfunctions.php";

    $idbarang = $_GET["id_barang"];
    if ( hapusdatabarang($idbarang) > 0 ) {
        echo "<script>
            alert('Data Barang Berhasil Dihapus');
            document.location.href = 'homeadmin.php#databarang';
        </script>";
    } else {
        echo "<script>
            alert('Data Barang Gagal Dihapus');
            document.location.href = 'homeadmin.php#databarang';
        </script>";
    }

    

?>