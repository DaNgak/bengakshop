<?php 

    session_start();
    if ( !isset($_SESSION["username"]) ){ 
        header("Location: login.php");
        exit;
    }

    if ( !isset($_GET["id_barang"]) ){ 
        header("Location: login.php");
        exit;
    }
    if ( !isset($_GET["username"]) ){ 
        header("Location: login.php");
        exit;
    }

    require "../allfunctions.php";

    $idbarang = $_GET["id_barang"];
    $userpembeli = $_GET["username"];

    $query = "SELECT
                id_barang,
                nama_barang, 
                foto_barang,
                deskripsi_barang,
                stok,
                harga,
                jb.jenis_barang
            FROM barang b
            INNER JOIN jenis_barang jb ON jb.id_jenis_barang = b.fk_id_jenis_barang
            WHERE id_barang=$idbarang";
    $databarangpopup = queryarray($query)[0];
?>

<div class="full-blur">
    <div class="pop-up-click">
        <div class="pop-up-click-left">
            <div class="brand-image">
                <img src="img/sahrul.png" alt="Image" width="300" height="375" />
            </div>
            <!-- <div class="size-bar glass4">
                <div class="size-info">
                    <input id="radiobutton1" type="radio" name="radiobuttongroup" />
                    <label for="radiobutton1">Size XXL</label>
                </div>
                <div class="size-info">
                    <input id="radiobutton2" type="radio" name="radiobuttongroup" />
                    <label for="radiobutton2">Size XL</label>
                </div>
                <div class="size-info">
                    <input id="radiobutton3" type="radio" name="radiobuttongroup" />
                    <label for="radiobutton3">Size XL</label>
                </div>
                <div class="size-info">
                    <input id="radiobutton4" type="radio" name="radiobuttongroup" />
                    <label for="radiobutton4">Size L</label>
                </div>
            </div> -->
            <div class="button-add-to-cart glass3">
                <a id="buttoncart" style="cursor: pointer;">
                    Add to Cart
                    <i class="fas fa-cart-plus"></i>
                </a>
            </div>
        </div>
        <div class="pop-up-click-right">
            <div class="brand-info">
                <div class="brand-title">
                    <h1><?= $databarangpopup["nama_barang"] ?></h1>
                </div>
                <div class="brand-kind-and-price">
                    <div class="brand-kind glass4">
                        <p><?= $databarangpopup["jenis_barang"] ?></p>
                    </div>
                    <div class="brand-price glass4">
                        <p><?= $databarangpopup["harga"] ?></p>
                    </div>
                </div>
                <div class="brand-add-to-list-and-favorit">
                    <div class="brand-to-list glass3">
                        <a id="buttonlist" style="cursor: pointer;" onclick="alert('Berhasil ditambahkan ke List\nTapi Boong');">
                            Add to List
                            <i class="fas fa-plus-square"></i>
                        </a>
                    </div>
                    <div class="brand-to-favo glass3">
                        <a id="buttonfavorit" style="cursor: pointer;" onclick="alert('Berhasil ditambahkan ke Favorit\nTapi Boong');">
                            Add to Favorit
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                </div>
                <div class="score-bar glass3">
                    <div class="score-number">
                        <h3>5.0</h3>
                    </div>
                    <!-- <div class="score-star">
                        <i>*****</i>
                    </div> -->
                    <div class="user-buying">
                        <i class="fas fa-user"></i>
                        10k++
                    </div>
                </div>
            </div>
            <div class="brand-desc">
                <h3 class="title-desc">Deskripsi</h3>
                <p>
                    <?= $databarangpopup["deskripsi_barang"] ?>
                </p>
            </div>
        </div>
        <div class="close-button">
            <a id="close-button" style="cursor: pointer;" onclick="kembalidaripopup();">X</a>
        </div>
    </div>
</div>