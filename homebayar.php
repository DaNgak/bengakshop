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

    // Tampil Data Barang
    $query = "SELECT 
                id_barang,
                nama_barang, 
                foto_barang, 
                jb.jenis_barang,
                harga
            FROM barang b
            INNER JOIN jenis_barang jb ON jb.id_jenis_barang = b.fk_id_jenis_barang";
    $databarang = queryarray($query);
    $username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>BengakShop Home</title>
        <link rel="stylesheet" href="css/fontawesome-free-5.15.3-web/css/all.min.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/glass.css" />
        <link rel="stylesheet" href="css/home.css" />
    </head>
    <body>
        <div class="background-blur">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
        <div class="navbar glass3">
            <div class="logo">
                <a href="about.php" target="_blank"> BengakShop </a>
            </div>
            <div class="search-bar">
                <!-- <form action=""> -->
                    <input type="text" placeholder="Search Product Here" id="inputsearchproduct" />
                    <button><span class="fas fa-search"></span></button>
                <!-- </form> -->
            </div>
            <div class="navbar-button">
                <?php if ( isset($_SESSION["loginpenjual"]) ) : ?>
                    <?php if ( $_SESSION["loginpenjual"] == 'true' ) : ?>
                        <div class="button-bar seller-bar">
                            <a href="penjual/homepenjual.php">Seller</a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="button-bar cart-bar">
                    <a href="#"><span class="fas fa-shopping-cart"></span></a>
                </div>
                <div class="button-bar profile-bar">
                    <a href="profile.php"><span class="fas fa-user"></span></a>
                </div>
                <div class="button-bar logout-bar">
                    <a href="logout.php" onclick="return confirm('Konfirmasi Logout'); ">Logout</a>
                </div>
            </div>
        </div>

        <div class="container-home-page">
            <div class="glass2">
                <div class="container-title">Trending</div>
                <div class="product-show" id="productview">
                    <?php foreach($databarang as $databarangsatuan) : ?>
                    <div class="glass3 product">
                        <a id="productclick" style="cursor: pointer;">
                            <input type="hidden" name="idbarang" id="valuedatabarang" value="<?= $databarangsatuan["id_barang"] ?>">
                            <input type="hidden" name="iduser" id="valuedatauserpembeli" value="<?= $username ?>">
                            <div class="product-top">
                                <div class="product-image"><img width="170" height="170" src="img/fotobarang/<?= $databarangsatuan["foto_barang"]; ?>" alt="<?= $databarangsatuan["nama_barang"]; ?>" /></div>
                                <div class="product-title"><?= $databarangsatuan["nama_barang"] ?><br>id barang = <?= $databarangsatuan["id_barang"] ?></div>
                            </div>
                            <div class="product-bottom">
                                <div class="product-kind"><?= $databarangsatuan["jenis_barang"] ?></div>
                                <div class="product-price"><?= $databarangsatuan["harga"] ?></div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="more-button">
                    <div class="button button-seeall">
                        <a href="#">See All</a>
                    </div>
                    <div class="button button-more">
                        <a href="#">More <span class="fas fa-arrow-circle-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- style="position:absolute;width: 50%; height: 300px; background-color:blue; align-self:center; z-index:10;" -->
        <div id="buyingpopup" class="d-none"></div>
        <script src="js/scriptajax.js"></script>
    </body>
</html>
