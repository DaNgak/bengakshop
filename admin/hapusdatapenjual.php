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
    $namabarang = $_GET["nama_toko"];
    if ( hapusdatapenjual($username, $namabarang) > 0 ) {
        echo "<script>
            alert('Data Penjual Berhasil Dihapus');
            document.location.href = 'homeadmin.php#datapenjualan';
        </script>";
    } else {
        echo "<script>
            alert('Data Penjual Gagal Dihapus');
            
        </script>";
    }


?>