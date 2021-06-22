<?php 

    session_start();

    if ( !isset($_SESSION["username"]) ){ 
        header("Location: ../login.php");
        exit;
    }

    if ( isset($_SESSION["loginadmin"]) ){
        header("Location: ../admin/homeadmin.php");
        exit;
    }

    if ( isset($_SESSION["loginpembeli"]) ){ 
        header("Location: ../index.php");
        exit;
    }

    require "../allfunctions.php";

    if ( !isset($_GET["id_barang"]) ) {
        header("Location: homepenjual.php");
        exit;
    }

    $idbarang = $_GET["id_barang"];
    if ( hapusdatabarang($idbarang) > 0 ) {
        echo "<script>
            alert('Data Berhasil Dihapus');
            document.location.href = 'homepenjual.php#dataproduksaya';
        </script>";
    } else {
        echo "<script>
            alert('Data Gagal Dihapus');
            document.location.href = 'editdataproduct.php?id_barang=$idbarang';
        </script>";
    }



?>