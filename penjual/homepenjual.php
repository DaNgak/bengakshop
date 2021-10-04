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

    require "../allfunctions.php";

    $username = $_SESSION["username"];
    $query = "SELECT 
                foto_toko,
                foto_ktp,
                nik, 
                nama_toko,
                kota,
                propinsi,
                deskripsi_toko,
                du.username,
                du.email
            FROM data_penjual dp
            INNER JOIN data_user du ON du.username = dp.fk_username
            WHERE du.username = '$username'";
    $dataprofilepenjual = queryarray($query)[0];
    $_SESSION["nama_toko"] = $dataprofilepenjual["nama_toko"];

    // Data Barang
    $namatoko = $_SESSION["nama_toko"];
    $query = "SELECT
                fk_nama_toko,
                id_barang,
                nama_barang,
                foto_barang,
                merek,
                harga,
                jb.jenis_barang
            FROM barang b
            INNER JOIN jenis_barang jb ON jb.id_jenis_barang = b.fk_id_jenis_barang
            WHERE fk_nama_toko='$namatoko'";
    $databarang = queryarray($query);
    
    // Data Pengiriman 
    $query = "SELECT * FROM jenis_pengiriman";
    $datapengiriman = queryarray($query);

    // Data Pembayaran 
    $query = "SELECT * FROM jenis_pembayaran";
    $datapembayaran = queryarray($query);

    // Data Jenis Barang 
    $query = "SELECT * FROM jenis_barang";
    $datajenisbarang = queryarray($query);

    // Data Satuan Barang
    $query = "SELECT * FROM satuan_barang";
    $datasatuanbarang = queryarray($query);

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
        <title>Penjual Page</title>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap");
            body {
                font-family: "Poppins", sans-serif;
                background-color: ghostwhite;
                overflow-X : hidden;
            }
            .container-custom {
                width: 95%;
            }
            nav {
                z-index: 3;
            }

            #dataproduksaya,
            #datapengiriman,
            #datapembayaran,
            #profile-penjual,
            #datapesanansaya {
                margin: 300px 0;
                padding-top: 75px;
            }

            .width-100 {
                width: 100%;
            }

            .z-indexminus {
                z-index: -1;
            }

            #slide-welcome-seller h1 {
                /* z-index: 2; */
                color: #0d6efd;
            }

            .height100vh {
                height: 100vh;
            }

            .zindexplus {
                z-index: 2;
            }

            .deskripsi-toko {
                text-align: justify;
                height: 150px;
                overflow-y: auto;
            }

            img.foto-ktp {
                width: 100%;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3 position-fixed top-0 start-0 end-0">
            <div class="container-md d-flex justify-content-between">
                <a class="navbar-brand" href="../about.php" target="_blank">BengakShop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-3">
                            <a class="nav-link active px-3" aria-current="page" href="#slide-welcome-seller">Home</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link active px-3" aria-current="page" href="#profile-penjual">Profile Seller</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link active px-3" aria-current="page" href="../index.php" onclick="return confirm('Konfirmasi Logout Seller Center');">Logout dari Seller Mode</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="slide-welcome-seller" class="carousel slide d-flex align-items-center justify-content-center text-center title-main height100vh" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#slide-welcome-seller" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#slide-welcome-seller" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#slide-welcome-seller" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../img/bg-page/bg-penjual1.jpg" class="d-block w-100" alt="Background-Hero" />
                </div>
                <div class="carousel-item">
                    <img src="../img/bg-page/bg-penjual2.jpg" class="d-block w-100" alt="Background-Hero" />
                </div>
                <div class="carousel-item">
                    <img src="../img/bg-page/bg-penjual3.jpg" class="d-block w-100" alt="Background-Hero" />
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#slide-welcome-seller" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#slide-welcome-seller" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            <div class="position-absolute">
                <h1>Selamat Datang di BengakShop</h1>
                <h1><?= $dataprofilepenjual["username"] ?></h1>
                <a href="#profile-penjual" class="btn btn-primary my-3">Lihat Data Toko</a>
            </div>
        </div>

        <section class="d-flex justify-content-center align-items-center" id="profile-penjual">
            <div class="container-md">
                <div class="row">
                    <div class="col-md my-4 text-center">
                        <h1 class="mb-4">Data Penjual</h1>
                        <p>
                            <a class="btn btn-warning" href="editprofilepenjual.php">Edit Data</a>
                            <a class="btn btn-primary mx-5" href="#dataproduksaya">Lihat Data Produk Saya</a>
                            <a class="btn btn-primary" href="#datapesanansaya">Lihat Data Penjualan Saya</a>
                            <a class="btn btn-primary mx-5" href="#datapengiriman">Support Pengiriman</a>
                            <a class="btn btn-primary" href="#datapembayaran">Support Pembayaran</a>
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="align-items-center my-3 text-center">
                            <span class="form-control">Foto Profile Toko</span>
                        </div>
                        <img src="../img/fotoprofiletoko/<?= $dataprofilepenjual["foto_toko"] ?>" alt="<?= $dataprofilepenjual["nama_toko"] ?>"  class="rounded mx-auto d-block" alt="karakter" width="250" height="250" />
                    </div>
                    <div class="col-md-5">
                        <div class="row align-items-center my-3">
                            <div class="col-md-4 align-items-center">
                                <span class="form-control">NIK KTP</span>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <span class="form-control"><?= $dataprofilepenjual["nik"] ?></span>
                            </div>
                        </div>
                        <div class="row align-items-center my-3">
                            <div class="col-md-4 align-items-center">
                                <span class="form-control">Username</span>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <span class="form-control"><?= $dataprofilepenjual["username"] ?></span>
                            </div>
                        </div>
                        <div class="row align-items-center my-3">
                            <div class="col-md-4 align-items-center">
                                <span class="form-control">Nama Toko</span>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <span class="form-control"><?= $dataprofilepenjual["nama_toko"] ?></span>
                            </div>
                        </div>
                        <div class="row align-items-center my-3">
                            <div class="col-md-4 align-items-center">
                                <span class="form-control">Email</span>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <span class="form-control"><?= $dataprofilepenjual["email"] ?></span>
                            </div>
                        </div>
                        <div class="row align-items-center my-3">
                            <div class="col-md-4 align-items-center">
                                <span class="form-control">Kabupaten/Kota</span>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <span class="form-control"><?= $dataprofilepenjual["kota"] ?></span>
                            </div>
                        </div>
                        <div class="row align-items-center my-3">
                            <div class="col-md-4 align-items-center">
                                <span class="form-control">Propinsi</span>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <span class="form-control"><?= $dataprofilepenjual["propinsi"] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="align-items-center my-3 text-center">
                            <div class="form-control">
                                Foto KTP Anda
                                <span class="btn btn-success ms-auto">Terverifikasi</span>
                            </div>
                        </div>
                        <img class="foto-ktp" src="../img/fotoktppenjual/<?= $dataprofilepenjual["foto_ktp"] ?>" alt="KTP <?= $dataprofilepenjual["username"] ?>" class="rounded mx-auto d-block" alt="karakter" width="400" height="250" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-2 align-items-center">
                        <span class="form-control">Deskripsi Toko</span>
                    </div>
                    <div class="col-md-10 align-items-center">
                        <span class="form-control deskripsi-toko"><?= $dataprofilepenjual["deskripsi_toko"] ?></span>
                    </div>
                </div>
            </div>
        </section>

        <section class="d-flex justify-content-center align-items-center" id="datapengiriman">
            <div class="container-md">
                <div class="to-bottom"></div>
                <h3 class="text-center mb-3">Data Layanan Pengiriman</h3>
                <div class="input-group my-3">
                    <input type="text" class="form-control" placeholder="Cari Data Layanan Pengiriman Berdasarkan Nama Pengiriman" id="inputcaridatapengiriman" />
                    <button class="btn btn-outline-primary" type="button" onclick="alert('Cari Jodoh ka Ngab');">Cari!!!</button>
                </div>
                <div class="overflow-auto" id="containerdatapengiriman">
                    <table class="table table-bordered">
                        <thead class="table-info">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama Pengiriman</th>
                                <th scope="col">Harga Pengiriman</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            <?php foreach($datapengiriman as $datapengirimansatuan) : ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td><?= $datapengirimansatuan["nama_pengiriman"] ?></td>
                                    <td><?= $datapengirimansatuan["harga_pengiriman"] ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="d-flex justify-content-center align-items-center" id="datapembayaran">
            <div class="container-md">
                <div class="to-bottom"></div>
                <h3 class="text-center mb-3">Data Layanan Pembayaran</h3>
                <div class="input-group my-3">
                    <input type="text" class="form-control" placeholder="Cari Data Layanan Pengiriman Berdasarkan Nama Pembayaran" id="inputcaridatapembayaran" />
                    <button class="btn btn-outline-primary" type="button" onclick="alert('Cari Jodoh ka Ngab');">Cari!!!</button>
                </div>
                <div class="overflow-auto" id="containerdatapembayaran">
                    <table class="table table-bordered">
                        <thead class="table-info">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach($datapembayaran as $datapembayaransatuan) : ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td><?= $datapembayaransatuan["nama_pembayaran"] ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="d-flex justify-content-center align-items-center" id="dataproduksaya">
            <div class="container-custom">
                <h3 class="text-center mb-3">Data Produk Saya</h3>
                <a href="tambahdataproduct.php" class="btn btn-primary width-100 my-3">Tambah Data Barang</a>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Data Berdasarkan Nama Barang atau Jenis Barang atau Merek Barang" id="inputcaridatabarang" />
                    <button class="btn btn-outline-primary" type="button" onclick="alert('Cari Jodoh ka Ngab');">Cari!!!</button>
                </div>
                <div class="overflow-auto" id="containerdatabarang">
                    <table class="table table-bordered">
                        <thead class="table-info">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Foto Barang</th>
                                <th scope="col">Merek Barang</th>
                                <th scope="col">Jenis Barang</th>
                                <th scope="col">Harga Barang</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach($databarang as $databarangsatuan) : ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td><?= $databarangsatuan["nama_barang"] ?></td>
                                    <td class="text-center"><img src="../img/fotobarang/<?= $databarangsatuan["foto_barang"] ?>" alt="Foto <?= $databarangsatuan["nama_barang"] ?>" width="100" height="100"></td>
                                    <td><?= $databarangsatuan["merek"] ?></td>
                                    <td><?= $databarangsatuan["jenis_barang"] ?></td>
                                    <td>Rp. <?= $databarangsatuan["harga"] ?></td>
                                    <td class="text-center"><a href="detaildataproduct.php?id_barang=<?= $databarangsatuan["id_barang"] ?>" class="btn btn-secondary">Detail</a></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="d-flex justify-content-center align-items-center" id="datapesanansaya">
            <div class="container-custom">
                <h3 class="text-center mb-3">Data Pesanan Saya</h3>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Data Berdasarkan Nama Barang atau Jenis Barang atau Merek Barang" id="inputcaridatatransaksi" />
                    <button class="btn btn-outline-primary" type="button" onclick="alert('Cari Jodoh ka Ngab');">Cari!!!</button>
                </div>
                <div class="overflow-auto" id="containerdatatransaksi">
                    <table class="table table-bordered">
                        <thead class="table-info">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Foto Barang</th>
                                <th scope="col">Merek Barang</th>
                                <th scope="col">Jenis Barang</th>
                                <th scope="col">Harga Barang</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach($databarang as $databarangsatuan) : ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td><?= $databarangsatuan["nama_barang"] ?></td>
                                    <td class="text-center"><img src="../img/fotobarang/<?= $databarangsatuan["foto_barang"] ?>" alt="Foto <?= $databarangsatuan["nama_barang"] ?>" width="100" height="100"></td>
                                    <td><?= $databarangsatuan["merek"] ?></td>
                                    <td><?= $databarangsatuan["jenis_barang"] ?></td>
                                    <td>Rp. <?= $databarangsatuan["harga"] ?></td>
                                    <td class="text-center"><a href="detaildataproduct.php?id_barang=<?= $databarangsatuan["id_barang"] ?>" class="btn btn-secondary">Detail</a></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <script src="../js/custom.js"></script>
        <script src="../js/scriptajaxpenjual.js"></script>
    </body>
</html>
