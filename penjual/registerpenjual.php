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

    require "../allfunctions.php";

    if ( isset($_POST["submit"]) ){
        $username = $_SESSION["username"];
        if( registrasiseller($_POST, $username) > 0 ){
            if ( updateaksesuser($username) > 0 ) {
                echo "<script>
                    alert('Registrasi Seller Sukses !!!\nSilahkan Login Ulang / Relog');
                    document.location.href = '../logout.php';
                </script>";
                header("Location: ../logout.php");
                exit;
            }
        } 
        
    
        echo "<script>
            alert('Registrasi Seller Gagal !!!');
        </script>";  
        
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Register Seller Page</title>
        <link rel="stylesheet" href="../css/fontawesome-free-5.15.3-web/css/all.min.css" />
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="../css/glass.css" />
        <link rel="stylesheet" href="../css/login.css" />
        <link rel="stylesheet" href="../css/register.css" />
    </head>
    <body>
        <div class="background-blur">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
        <div class="background-hero-3">
            <img src="../img/bg-page/bg-register-penjual.png" alt="Background Hero" />
        </div>
        <div class="button button-login">
            <a href="../profile.php">
                <span class="fas fa-arrow-circle-left"></span>
                Kembali
            </a>
        </div>
        <div class="container-register">
            <div class="title-page">
                <h1>Register Menjadi Seller</h1>
            </div>
            <div class="glass1 register-form">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="input form-username">
                        <label for="namatoko">Nama Toko</label>
                        <input class="button" type="text" name="namatoko" id="namatoko" placeholder="Nama Toko" required />
                    </div>
                    <div class="input from-ktp">
                        <label for="fotoktp">Foto KTP</label>
                        <input class="button" type="file" name="fotoktp" id="fotoktp" required />
                    </div>
                    <div class="input from-ktp">
                        <label for="nikktp">NIK KTP</label>
                        <input class="button" type="number" name="nikktp" id="nikktp" placeholder="NIK KTP" size="16" required />
                    </div>
                    <div class="from-password">
                        <div class="input from-password-kiri">
                            <label for="kabupatenkota">Kabupaten/Kota</label>
                            <input class="button" type="text" name="kabupatenkota" id="kabupatenkota" placeholder="Kabupaten / Kota" required />
                        </div>
                        <div class="input from-password-kanan">
                            <label for="proponsi">Propinsi</label>
                            <input class="button" type="text" name="proponsi" id="proponsi" placeholder="Proponsi" required />
                        </div>
                    </div>
                    <button class="button button-kirim" type="submit" name="submit">Register</button>
                </form>
            </div>
        </div>
        <div class="contact-sosmed">
            <div class="contact email">
                <a href="#">
                    <i class="fas fa-at"></i>
                </a>
            </div>
            <div class="contact facebook">
                <a href="#">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </div>
            <div class="contact instagram">
                <a href="#">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </body>
</html>
