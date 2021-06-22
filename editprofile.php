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

    require "allfunctions.php";

    $username = $_SESSION["username"];

    $query = "SELECT * FROM data_user WHERE username='$username'";
    $dataprofile = queryarray($query)[0];

    if ( isset($_POST["submit"]) ){
        if ( updatedatauser($_POST) > 0 ) {
            echo "<script>
                alert('Data User Berhasil Diubah');
                document.location.href = 'profile.php';
            </script>";
        } else {
            echo "<script>
                alert('Data User Gagal Diubah');
            </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Edit Profile Page</title>
        <link rel="stylesheet" href="css/fontawesome-free-5.15.3-web/css/all.min.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/glass.css" />
        <link rel="stylesheet" href="css/login.css" />
        <link rel="stylesheet" href="css/register.css" />
    </head>
    <body>
        <div class="background-blur">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
        <div class="background-hero-4">
            <img src="img/bg-page/bg-edit-user.png" alt="Background Hero" />
        </div>
        <div class="button button-login">
            <a href="profile.php">
                <span class="fas fa-arrow-circle-left"></span>
                Kembali
            </a>
        </div>
        <div class="container-register">
            <div class="title-page">
                <h1>Edit Profile User</h1>
            </div>
            <div class="glass1 register-form">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $dataprofile["foto_profil"] ?>" name="fotoprofiluserlama">
                    <input type="hidden" value="<?= $username ?>" name="username">
                    <div class="from-password">
                        <div class="input from-password-kiri">
                            <label for="username">Username</label>
                            <div class="button" id="usernamevalue"><?= $dataprofile["username"] ?></div>
                        </div>
                        <div class="input from-password-kanan">
                            <label for="password">Password</label>
                            <input class="button" type="text" name="password" id="password" value="<?= $dataprofile["password"] ?>" required />
                        </div>
                    </div>
                    <div class="input from-profile">
                        <label for="usernamevalue">Email</label>
                        <div class="button" name="emailprofile" id="usernamevalue" ><?= $dataprofile["email"] ?></div>
                    </div>
                    <div class="input from-profile">
                        <label for="fotoprofile">Foto Profile</label>
                        <input class="button" type="file" name="fotoprofileuser" id="fotoprofile" />
                    </div>
                    <button class="button button-kirim" type="submit" name="submit">Edit Profile</button>
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
        <script>
            alert("1 .Harap Perhatikan Saat Ganti Password karena belum support fitur Forget Password\n2. Jika tidak ingin mengubah foto profil tidak usah mengisi form input gambarnya!!!");
        </script>
    </body>
</html>
