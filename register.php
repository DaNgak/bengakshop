<?php 

    session_start();

    // if ( isset($_SESSION["loginadmin"]) ){
    //     header("Location: admin/homeadmin.php");
    //     exit;
    // }

    // if ( isset($_SESSION["loginpenjual"]) ){
    //     header("Location: index.php");
    //     exit;
    // }

    // if ( isset($_SESSION["loginpembeli"]) ){
    //     header("Location: index.php");
    //     exit;
    // }

    if ( isset($_SESSION["loginadmin"]) ){
        header("Location: admin/homeadmin.php");
        exit;
    }

    if ( isset($_SESSION["username"]) ){ 
        header("Location: index.php");
        exit;
    }

    require "allfunctions.php";
    
    if ( isset($_POST["register"]) ) {
        if ( registrasiuser($_POST) > 0) {
            echo "<script>
                alert('Registrasi Berhasil, Silahkan Login!!!');
                document.location.href = 'login.php';
            </script>";
            exit;
        } else {
            $error = mysqli_error($conn);
            echo "<script>
                alert('Registrasi Gagal');
                console.log('$error');
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
        <title>Register Page</title>
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
        <div class="background-hero-2">
            <img src="img/bg-page/bg-register.png" alt="Background Hero" />
        </div>
        <div class="button button-login">
            <a href="login.php">
                <span class="fas fa-arrow-circle-left"></span>
                Login
            </a>
        </div>
        <div class="container-register">
            <div class="title-page">
                <h1>BengakShop</h1>
            </div>
            <div class="glass1 register-form">
                <form action="" method="POST">
                    <div class="input form-username">
                        <label for="username">Username</label>
                        <input class="button" type="text" name="username" id="username" placeholder="Username" required />
                    </div>
                    <div class="input from-password">
                        <label for="email">Email</label>
                        <input class="button" type="email" name="email" id="email" placeholder="Email" required />
                    </div>
                    <div class="from-password">
                        <div class="input from-password-kiri">
                            <label for="password">Password</label>
                            <input class="button" type="password" name="password" id="password" placeholder="Password" required />
                        </div>
                        <div class="input from-password-kanan">
                            <label for="re-password">Confirm Password</label>
                            <input class="button" type="password" name="confirmpassword" id="re-password" placeholder="Re-Password" required />
                        </div>
                    </div>
                    <button class="button button-kirim" type="submit" name="register">Register</button>
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
