<?php 

    session_start();

    if ( isset($_SESSION["loginadmin"]) ){
        header("Location: admin/homeadmin.php");
        exit;
    }

    if ( isset($_SESSION["username"]) ){ 
        header("Location: index.php");
        exit;
    }

    // if ( isset($_SESSION["loginpenjual"]) ){
    //     header("Location: index.php");
    //     exit;
    // }

    // if ( isset($_SESSION["loginpembeli"]) ){
    //     header("Location: index.php");
    //     exit;
    // }

    require "allfunctions.php";

    if ( isset($_POST["submit"]) ){
        $username = strtolower($_POST["username"]);
        $password = $_POST["password"];
        // Cek apakah admin
        $result = mysqli_query($conn, "SELECT username, password FROM data_user WHERE username='$username' AND fk_id_akses=1");
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            if($row["username"] === $username && $row["password"] === $password){
                $_SESSION["loginadmin"] = 'true';
                $_SESSION["username"] = $username;
                echo "<script>
                    alert('Login Berhasil!!!');
                    document.location.href = 'admin/homeadmin.php';
                </script>";
                exit;
            }
        }

        // Cek apakah penjual
        $result = mysqli_query($conn, "SELECT username, password FROM data_user WHERE username='$username' AND fk_id_akses=2");
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            if($row["username"] === $username && $row["password"] === $password){
                $_SESSION["loginpenjual"] = 'true';
                $_SESSION["username"] = $username;
                echo "<script>
                    alert('Login Berhasil!!!');
                    document.location.href = 'index.php';
                </script>";
                exit;
            }
        }

        // Cek apakah user / pembeli
        $result = mysqli_query($conn, "SELECT username, password FROM data_user WHERE username='$username' AND fk_id_akses=3");
        $row = mysqli_fetch_assoc($result);
        if($row){
            if($row["username"] === $username && $row["password"] === $password){
                $_SESSION["loginpembeli"] = 'true';
                $_SESSION["username"] = $username;
                echo "<script>
                    alert('Login Berhasil!!!');
                    document.location.href = 'index.php';
                </script>";
                exit;
            }
        }

        echo "<script>
            alert('Login Gagal!!!');
        </script>";
        
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/login.css" />
        <link rel="stylesheet" href="css/glass.css" />
        <link rel="stylesheet" href="css/fontawesome-free-5.15.3-web/css/all.min.css" />
        <title>Login Pane</title>
    </head>
    <body>
        <div class="background-blur">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
        <div class="background-hero">
            <img src="img/bg-page/bg-login.png" alt="Background Hero" />
        </div>
        <div class="button button-register">
            <a href="register.php">
                Register
                <span class="fas fa-arrow-circle-right"></span>
            </a>
        </div>
        <div class="container">
            <div class="title-page">
                <h1>BengakShop</h1>
            </div>
            <div class="glass1 register-form">
                <form action="" method="POST">
                    <div class="input form-username">
                        <label for="username">Username</label>
                        <input class="button" type="text" name="username" id="username" placeholder="Username" autofocus required />
                    </div>
                    <div class="input from-password">
                        <label for="password">Password</label>
                        <input class="button" type="password" name="password" id="password" placeholder="Password" required />
                    </div>
                    <a class="forget-password" href="#">Forget Password ?</a>
                    <button class="button button-kirim" type="submit" name="submit">Login</button>
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
