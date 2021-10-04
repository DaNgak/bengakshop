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
    
    if ( !isset($_GET["id_pembelian"]) ) {
        header("Location: homeadmin.php");
        exit;
    }
        
    $idpembelian = $_GET["id_pembelian"];

    // Data Transaksi Lengkap
    $query = "SELECT
                *,
                jk.id_jenis_pengiriman,
                jk.nama_pengiriman,
                jk.harga_pengiriman,
                jb.id_jenis_pembayaran,
                jb.nama_pembayaran,
                b.id_barang,
                b.nama_barang,
                b.fk_nama_toko,
                b.fk_id_jenis_barang,
                sb.id_satuan_barang,
                sb.nama_satuan,
                sb.jumlah_barang,
                (harga * (total_pembelian_barang * sb.jumlah_barang) + jk.harga_pengiriman) as totalhargabeli
            FROM pembelian p
            INNER JOIN jenis_pengiriman jk ON jk.id_jenis_pengiriman = p.fk_jenis_pengiriman
            INNER JOIN jenis_pembayaran jb ON jb.id_jenis_pembayaran = p.fk_id_jenis_pembayaran
            INNER JOIN barang b ON b.id_barang = p.fk_id_barang
            INNER JOIN satuan_barang sb ON sb.id_satuan_barang = p.fk_satuan_barang

            WHERE id_pembelian=$idpembelian";
    $datatransaksibarang = queryarray($query)[0];
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
                display: flex;
                justify-content: center;
            }

            .harga-product{
                height: 175px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>
    </head>
    <body>
        <section class="container-custom mx-auto">
            <div class="row text-center mt-2 mb-3">
                <h1>Detail Data Product</h1>
                <p>
                    <a class="btn btn-primary mx-5" href="homeadmin.php#datatransaksibarang">Kembali</a>
                    <a class="btn btn-danger" href="hapusdatatransaksi.php?id_barang=<?= $idbarang ?>" onclick="return confirm('Konfirmasi Ingin Hapus Data ??'); ">Hapus Data Product</a>
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">ID Transaksi / Product</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $datatransaksibarang["id_pembelian"] ?> / <?= $datatransaksibarang["id_barang"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Username Pembeli</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $datatransaksibarang["fk_username_pembeli"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Nama Toko</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $datatransaksibarang["fk_nama_toko"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Nama Product</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $datatransaksibarang["nama_barang"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Merek Product</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $datatransaksibarang["merek"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Harga Product</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $datatransaksibarang["harga"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Total Pembelian Barang</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $datatransaksibarang["total_pembelian_barang"] ?> - <?= $datatransaksibarang["nama_satuan"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Jasa Pengiriman</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $datatransaksibarang["nama_pengiriman"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Harga Pengiriman</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $datatransaksibarang["harga_pengiriman"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Metode Pembayaran</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $datatransaksibarang["nama_pembayaran"] ?></span>
                        </div>
                    </div>
                    <div class="row align-items-center my-3">
                        <div class="col-md-4 align-items-center">
                            <span class="form-control">Alamat Pengiriman</span>
                        </div>
                        <div class="col-md-8 align-items-center">
                            <span class="form-control"><?= $datatransaksibarang["alamat_pengiriman"] ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="align-items-center my-3 text-center">
                                <div class="form-control">Foto Product</div>
                            </div>
                            <span class="form-control deskripsi-product">
                                <img width="250" height="250" class="mx-auto rounded" src="../img/fotobarang/<?= $datatransaksibarang["foto_barang"] ?>" alt="Foto Produk">
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="align-items-center my-3 text-center">
                                <div class="form-control">Total Harga</div>
                            </div>
                            <span class="form-control mb-5 harga-product">
                                <h1 class="fw-bold"><?= $datatransaksibarang["totalhargabeli"] ?></h1>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="../js/custom.js"></script>
    </body>
</html>
