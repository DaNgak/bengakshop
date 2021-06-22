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
    // if ( !isset($_SESSION["loginpenjual"]) ){ 
    //     header("Location: ../login.php");
    //     exit;
    // } 

    // if ( !isset($_SESSION["loginadmin"]) ){
    //     header("Location: ../login.php");
    //     exit;
    // } else {
    //     header("Location: ../admin/homeadmin.php");
    //     exit;
    // }

    // if ( !isset($_SESSION["loginpembeli"]) ){ 
    //     header("Location: ../login.php");
    //     exit;
    // } else {
    //     header("Location: ../index.php");
    //     exit;
    // }

    require "../allfunctions.php";
    
    if ( !isset($_GET["id_barang"]) ) {
        header("Location: homepenjual.php");
        exit;
    }
        
    $idbarang = $_GET["id_barang"];

    // Data Barang Lengkap
    $query = "SELECT 
                *, 
                jb.jenis_barang 
            FROM barang b
            INNER JOIN jenis_barang jb ON jb.id_jenis_barang = b.fk_id_jenis_barang
            WHERE id_barang=$idbarang";
    $databaranglengkap = queryarray($query)[0];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../css/customstyle.css" />
        <title>Detail Data Product</title>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap");
            body {
                font-family: "Poppins", sans-serif;
                overflow-x: hidden;
                width: 100%;
                background-color: ghostwhite;
            }
            .width-100 {
                width: 100%;
            }

            .container-custom {
                width: 95%;
            }

            .deskripsi-product {
                height: 250px;
                overflow-y: auto;
                text-align: justify;
            }
        </style>
    </head>
    <body>
        <section class="container-custom mx-auto">
            <div class="row text-center mt-2 mb-3">
                <h1>Detail Data Product</h1>
                <p>
                    <a class="btn btn-warning" href="editdataproduct.php?id_barang=<?= $databaranglengkap["id_barang"] ?>">Edit Data Product</a>
                    <a class="btn btn-primary mx-5" href="homepenjual.php">Kembali</a>
                    <a class="btn btn-danger" href="hapusdatabarang.php?id_barang=<?= $idbarang ?>" onclick="return confirm('Konfirmasi Ingin Hapus Data ??'); ">Hapus Data Product</a>
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="align-items-center my-3 text-center">
                        <span class="form-control">Foto Product</span>
                    </div>
                    <img src="../img/fotobarang/<?= $databaranglengkap["foto_barang"] ?>" class="rounded mx-auto d-block" alt="Foto <?= $databaranglengkap["nama_barang"] ?>" width="250" height="250" />
                </div>
                <div class="col-md-5">
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">ID Product</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $databaranglengkap["id_barang"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Nama Product</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $databaranglengkap["nama_barang"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Merek Product</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $databaranglengkap["merek"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Jenis Product</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $databaranglengkap["jenis_barang"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Stok Product</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $databaranglengkap["stok"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Harga Product</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $databaranglengkap["harga"] ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="align-items-center my-3 text-center">
                        <div class="form-control">Deskripsi Product</div>
                    </div>
                    <span class="form-control deskripsi-product"><?= $databaranglengkap["deskripsi_barang"] ?></span>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-auto mb-3">
                    <div class="form-control px-5">Foto Product View</div>
                </div>
                <div class="row justify-content-evenly">
                    <div class="col-md-3">
                        <img class="d-block mx-auto" src="../img/fotobarang/<?= $databaranglengkap["foto_barang"] ?>" width="250" height="250" alt="" />
                    </div>
                    <div class="col-md-3">
                        <img class="d-block mx-auto" src="../img/fotobarang/<?= $databaranglengkap["foto_barang"] ?>" width="250" height="250" alt="" />
                    </div>
                    <div class="col-md-3">
                        <img class="d-block mx-auto" src="../img/fotobarang/<?= $databaranglengkap["foto_barang"] ?>" width="250" height="250" alt="" />
                    </div>
                    <div class="col-md-3">
                        <img class="d-block mx-auto" src="../img/fotobarang/<?= $databaranglengkap["foto_barang"] ?>" width="250" height="250" alt="" />
                    </div>
                </div>
            </div>
        </section>
        <script src="../js/custom.js"></script>
    </body>
</html>
