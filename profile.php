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

    $username = $_SESSION["username"] ;

    // Tampil Profile User
    $query = "SELECT username, foto_profil FROM data_user WHERE username='$username'";
    $dataprofile = queryarray($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Profile User Page</title>
        <link rel="stylesheet" href="css/fontawesome-free-5.15.3-web/css/all.min.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/glass.css" />
        <link rel="stylesheet" href="css/profile.css">
    </head>
    <body>
        <div class="background-blur-dua">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
        <div class="container-grid">
            <div class="info-profile-template">
                <div class="profile-box">
                    <div class="glass3 inner-profile-box">
                        <img src="img/fotoprofileuser/<?= $dataprofile[0]["foto_profil"] ?>" alt="Foto Profile <?=  $dataprofile[0]["username"] ?>" width="200" height="200" alt="" />
                    </div>
                </div>  
                <div class="username-box glass-username">
                    <p>Username</p>
                    <p><?= $dataprofile[0]["username"] ?></p>
                </div>
                <div class="edit-box glass-username">
                    <a class="edit-profile-button" href="editprofile.php">Edit Profile</a>
                    <?php if( isset($_SESSION["loginpenjual"]) ) : ?>
                        <a class="view-feedback-button" href="penjual/homepenjual.php">Seller Center</a>
                    <?php else : ?> 
                        <a class="view-feedback-button" href="penjual/registerpenjual.php">Register Penjual</a>
                    <?php endif; ?>
                </div>
                <div class="navigation-button">
                    <!-- class contact ambil dari glass.css -->
                    <!-- Buat ambil css / stylenya -->
                    <div class="button-back contact glass-username">
                        <a href="index.php">
                            <i class="fas fa-arrow-circle-left"></i>
                        </a>
                    </div>
                    <!-- class contact ambil dari glass.css -->
                    <!-- Buat ambil css / stylenya -->
                    <div class="button-home contact glass-username">
                        <a href="index.php">
                            <i class="fas fa-home"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="recent-view-template">
                <div class="glass-view-favorites info-recent">Recent View</div>
                <div class="product-info">
                    <div class="glass3 product">
                        <a href="#">
                            <div class="product-top">
                                <div class="product-image"><img src="img/nico2.png" alt="" /></div>
                                <div class="product-title">asdaasdasdaaaa asdasdasdasaaaa asdasdadasaaaa</div>
                            </div>
                            <!-- <div class="product-desc">Vol 13</div> -->
                            <div class="product-bottom">
                                <div class="product-kind">Manga</div>
                                <div class="product-price">$50</div>
                            </div>
                        </a>
                    </div>
                    <div class="glass3 product">
                        <a href="#">
                            <div class="product-top">
                                <div class="product-image"><img src="img/nico2.png" alt="" /></div>
                                <div class="product-title">asdaasdasdaaaa asdasdasdasaaaa asdasdadasaaaa</div>
                            </div>
                            <!-- <div class="product-desc">Vol 13</div> -->
                            <div class="product-bottom">
                                <div class="product-kind">Manga</div>
                                <div class="product-price">$50</div>
                            </div>
                        </a>
                    </div>
                    <div class="glass3 product">
                        <a href="#">
                            <div class="product-top">
                                <div class="product-image"><img src="img/nico2.png" alt="" /></div>
                                <div class="product-title">asdaasdasdaaaa asdasdasdasaaaa asdasdadasaaaa</div>
                            </div>
                            <!-- <div class="product-desc">Vol 13</div> -->
                            <div class="product-bottom">
                                <div class="product-kind">Manga</div>
                                <div class="product-price">$50</div>
                            </div>
                        </a>
                    </div>
                    <div class="glass3 product">
                        <a href="#">
                            <div class="product-top">
                                <div class="product-image"><img src="img/nico2.png" alt="" /></div>
                                <div class="product-title">asdaasdasdaaaa asdasdasdasaaaa asdasdadasaaaa</div>
                            </div>
                            <!-- <div class="product-desc">Vol 13</div> -->
                            <div class="product-bottom">
                                <div class="product-kind">Manga</div>
                                <div class="product-price">$50</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="recent-favorite-template">
                <div class="glass-view-favorites info-recent">Recent Favorites</div>
                <div class="product-info">
                    <div class="glass3 product">
                        <a href="#">
                            <div class="product-top">
                                <div class="product-image"><img src="img/nico2.png" alt="" /></div>
                                <div class="product-title">asdaasdasdaaaa asdasdasdasaaaa asdasdadasaaaa</div>
                            </div>
                            <!-- <div class="product-desc">Vol 13</div> -->
                            <div class="product-bottom">
                                <div class="product-kind">Manga</div>
                                <div class="product-price">$50</div>
                            </div>
                        </a>
                    </div>
                    <div class="glass3 product">
                        <a href="#">
                            <div class="product-top">
                                <div class="product-image"><img src="img/nico2.png" alt="" /></div>
                                <div class="product-title">asdaasdasdaaaa asdasdasdasaaaa asdasdadasaaaa</div>
                            </div>
                            <!-- <div class="product-desc">Vol 13</div> -->
                            <div class="product-bottom">
                                <div class="product-kind">Manga</div>
                                <div class="product-price">$50</div>
                            </div>
                        </a>
                    </div>
                    <div class="glass3 product">
                        <a href="#">
                            <div class="product-top">
                                <div class="product-image"><img src="img/nico2.png" alt="" /></div>
                                <div class="product-title">asdaasdasdaaaa asdasdasdasaaaa asdasdadasaaaa</div>
                            </div>
                            <!-- <div class="product-desc">Vol 13</div> -->
                            <div class="product-bottom">
                                <div class="product-kind">Manga</div>
                                <div class="product-price">$50</div>
                            </div>
                        </a>
                    </div>
                    <div class="glass3 product">
                        <a href="#">
                            <div class="product-top">
                                <div class="product-image"><img src="img/nico2.png" alt="" /></div>
                                <div class="product-title">asdaasdasdaaaa asdasdasdasaaaa asdasdadasaaaa</div>
                            </div>
                            <!-- <div class="product-desc">Vol 13</div> -->
                            <div class="product-bottom">
                                <div class="product-kind">Manga</div>
                                <div class="product-price">$50</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
