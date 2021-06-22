<?php 

    session_start();

    // if ( !isset($_SESSION["loginadmin"]) ){
    //     header("Location: login.php");
    //     exit;
    // }

    // if ( !isset($_SESSION["loginpenjual"]) ){ 
    //     header("Location: login.php");
    //     exit;
    // }

    // if ( !isset($_SESSION["loginpembeli"]) ){ 
    //     header("Location: login.php");
    //     exit;

    if ( !isset($_SESSION["username"]) ){ 
        header("Location: login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>About Page</title>
        <link rel="stylesheet" href="css/fontawesome-free-5.15.3-web/css/all.min.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/glass.css" />
        <link rel="stylesheet" href="css/about.css" />
    </head>
    <body>
        <div class="background-blur-tiga">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
        <div class="container-grid">
            <div class="left-template">
                <div class="background-hero">
                    <div class="set-hero">
                        <img class="hero1" src="img/bg-page/bg-about-men.png" alt="Background-About" />
                        <img class="hero2" src="img/bg-page/bg-about-girl.png" alt="Background-About" />
                    </div>
                </div>
                <div class="title-page">
                    <h1>About BengakShop</h1>
                </div>
                <div class="button-back-to-home">
                    <a class="glass4" href="#">
                        <i class="fas fa-home"></i>
                        Back to Home
                    </a>
                </div>
            </div>
            <div class="right-template">
                <div class="about-template glass4">
                    <div></div>
                    <div class="about-info">
                        <div class="about-title">
                            <p class="glass3">About</p>
                        </div>
                        <div class="about-desc glass3">
                            <p>BengakShop adalah sebuah e-commerce yang menyediakan berbagai barang yang dapat dibeli dengan sistem online.</p>
                        </div>
                    </div>
                    <div class="team-info">
                        <div class="team-title">
                            <p class="glass3">My Team</p>
                        </div>
                        <div class="team-template">
                            <div class="team-desc team">
                                <a href="#">
                                    <img class="glass-team" src="img/developer/adit.jpeg" alt="" width="125" height="125" />
                                    <p>Aditya Raihan</p>
                                </a>
                            </div>
                            <div class="team-desc team">
                                <a href="#">
                                    <img class="glass-team" src="img/developer/me.jpeg" alt="" width="125" height="125" />
                                    <p>Aria Pratama E.</p>
                                </a>
                            </div>
                            <div class="team-desc team">
                                <a href="#">
                                    <img class="glass-team" src="img/developer/zaidan.jpeg" alt="" width="125" height="125" />
                                    <p>M. Zaidan Fikri</p>
                                </a>
                            </div>
                            <div class="team-desc team">
                                <a href="#">
                                    <img class="glass-team" src="img/developer/sahrol.jpeg" alt="" width="125" height="125" />
                                    <p>Syahrul Eka P.</p>
                                </a>
                            </div>
                            <div class="team-desc team">
                                <a href="#">
                                    <img class="glass-team" src="img/developer/nicofix.jpeg" alt="" width="125" height="125" />
                                    <p>Wazir Qorni A.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
