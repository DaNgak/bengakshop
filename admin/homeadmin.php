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

    require "../allfunctions.php";
    // Data Pembeli
    $query = "SELECT * FROM data_user WHERE fk_id_akses = '3'";
    $datapembeli = queryarray($query);

    // Data Penjual
    $query = "SELECT 
                dp.kota,
                dp.propinsi,
                dp.nik,
                dp.nama_toko,
                username,
                password, 
                email
            FROM data_user du 
            INNER JOIN data_penjual dp on dp.fk_username = du.username";
    $datapenjual = queryarray($query);

    // Data Barang
    // $query = "SELECT * FROM "

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

    // Data Barang Lengkap
    $query = "SELECT
                id_barang,
                nama_barang,
                foto_barang,
                merek,
                stok,
                harga,
                jb.jenis_barang,
                dp.fk_username,
                dp.nama_toko
            FROM barang b
            INNER JOIN jenis_barang jb ON jb.id_jenis_barang = b.fk_id_jenis_barang
            INNER JOIN data_penjual dp ON dp.nama_toko = b.fk_nama_toko";
    $databaranglengkap = queryarray($query);

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../css/customstyle.css" />
        <title>Admin Page</title>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap");
            body {
                font-family: "Poppins", sans-serif;
                overflow-x: hidden;
                width: 100%;
                background-color: ghostwhite;
            }
            nav {
                z-index: 3;
            }
            .container-custom {
                width: 95%;
                margin: 0 auto 400px;
            }
            .container-custom .to-bottom {
                width: 100%;
                height: 10px;
                margin-bottom: 100px;
            }
            .title-main {
                margin-top: 100px;
            }
            .width-100 {
                width: 100%;
            }
            ul.navbar-nav li.nav-item.dropdown {
                border-right: 1px solid white;
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
                        <li class="nav-item dropdown px-4 mx-3">
                            <a class="nav-link active dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Pilih Data </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#datapembeli">Data Pembeli</a></li>
                                <li><a class="dropdown-item" href="#datapenjual">Data Penjual</a></li>
                                <li><a class="dropdown-item" href="#databarang">Data Barang</a></li>
                                <li><a class="dropdown-item" href="#datapengiriman">Data Pengiriman</a></li>
                                <li><a class="dropdown-item" href="#datapembayaran">Data Pembayaran</a></li>
                                <li><a class="dropdown-item" href="#datasatuanbarang">Data Satuan Barang</a></li>
                                <li><a class="dropdown-item" href="#datajenisbarang">Data Jenis Barang</a></li>
                            </ul>
                        </li>
                        <li class="nav-item mx-3 px-3">
                            <a class="nav-link active" aria-current="page" href="logoutadmin.php" onclick="return confirm('Konfirmasi Logout');">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="text-center title-main mx-5">
            <h1>Selamat Datang di BengakShop</h1>
        </div>
        <div class="container-custom" id="datapembeli">
            <div class="to-bottom"></div>
            <h3 class="text-center mb-3">Data Pembeli</h3>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Data Berdasarkan Username atau Email" aria-describedby="button-addon2" />
                <button class="btn btn-outline-primary" type="button" id="button-addon2">Cari!!!</button>
            </div>
            <div class="overflow-auto">
                <table class="table table-bordered">
                    <thead class="table-info">
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Email</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($datapembeli as $datapembelisatuan) : ?>
                        <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td><?= $datapembelisatuan["username"] ?></td>
                            <td><?= $datapembelisatuan["password"] ?></td>
                            <td><?= $datapembelisatuan["email"] ?></td>
                            <td class="text-center"><a href="hapusdatapembeli?username=<?= $datapembelisatuan["username"] ?>" class="btn btn-danger" onclick="return confirm('Konfirmasi Hapus ?'); ">Delete</a></td>
                            <?php $i++ ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container-custom" id="datapenjual">
            <div class="to-bottom"></div>
            <h3 class="text-center mb-3">Data Penjual</h3>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Data Berdasarkan Username atau Email atau NIK" aria-describedby="button-addon2" />
                <button class="btn btn-outline-primary" type="button" id="button-addon2">Cari!!!</button>
            </div>
            <div class="overflow-auto">
                <table class="table table-bordered">
                    <thead class="table-info">
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Username</th>
                            <th scope="col">Nama Toko</th>
                            <th scope="col">Password</th>
                            <th scope="col">Email</th>
                            <th scope="col">NIK KTP</th>
                            <th scope="col">Daerah</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach($datapenjual as $datapenjualsatuan) : ?>
                        <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td><?= $datapenjualsatuan["username"] ?></td>
                            <td><?= $datapenjualsatuan["nama_toko"] ?></td>
                            <td><?= $datapenjualsatuan["password"] ?></td>
                            <td><?= $datapenjualsatuan["email"] ?></td>
                            <td><?= $datapenjualsatuan["nik"] ?></td>
                            <td><?= $datapenjualsatuan["kota"] ?> / <?= $datapenjualsatuan["propinsi"] ?></td>
                            <td class="text-center"><a href="hapusdatapenjual.php?username=<?= $datapenjualsatuan["username"] ?>&nama_toko=<?= $datapenjualsatuan["nama_toko"] ?>" class="btn btn-danger" onclick="return confirm('Konfirmasi Hapus ?'); ">Delete</a></td>
                            <?php $i++ ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container-custom" id="datapengiriman">
            <div class="to-bottom"></div>
            <h3 class="text-center mb-3">Data Layanan Pengiriman</h3>
            <a href="#" class="text-center btn btn-primary my-3 width-100">Tambah Data Pengiriman</a>
            <div class="input-group my-3">
                <input type="text" class="form-control" placeholder="Cari Data Layanan Pengiriman Berdasarkan Nama Pengiriman" aria-describedby="button-addon2" />
                <button class="btn btn-outline-primary" type="button" id="button-addon2">Cari!!!</button>
            </div>
            <div class="overflow-auto">
                <table class="table table-bordered">
                    <thead class="table-info">
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama Pengiriman</th>
                            <th scope="col">Harga Pengiriman</th>
                            <th colspan="2" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($datapengiriman as $datapengirimansatuan) : ?>
                        <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td><?= $datapengirimansatuan["nama_pengiriman"] ?></td>
                            <td><?= $datapengirimansatuan["harga_pengiriman"] ?></td>
                            <td class="text-center"><button type="button" class="btn btn-warning">Edit</button></td>
                            <td class="text-center"><button type="button" class="btn btn-danger">Delete</button></td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container-custom" id="datasatuanbarang">
            <div class="to-bottom"></div>
            <h3 class="text-center mb-3">Data Satuan Barang</h3>
            <a href="#" class="text-center btn btn-primary my-3 width-100">Tambah Data Satuan Barang</a>
            <div class="input-group my-3">
                <input type="text" class="form-control" placeholder="Cari Data Satuan Barang Berdasarkan Nama Satuan" aria-describedby="button-addon2" />
                <button class="btn btn-outline-primary" type="button" id="button-addon2">Cari!!!</button>
            </div>
            <div class="overflow-auto">
                <table class="table table-bordered">
                    <thead class="table-info">
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama Satuan Barang</th>
                            <th scope="col">Total Barang</th>
                            <th colspan="2" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($datasatuanbarang as $datasatuanbarangsatuan) : ?>
                        <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td><?= $datasatuanbarangsatuan["nama_satuan"] ?></td>
                            <td><?= $datasatuanbarangsatuan["jumlah_barang"] ?></td>
                            <td class="text-center"><button type="button" class="btn btn-warning">Edit</button></td>
                            <td class="text-center"><button type="button" class="btn btn-danger">Delete</button></td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <div class="container-custom" id="datajenisbarang">
            <div class="to-bottom"></div>
            <h3 class="text-center mb-3">Data Jenis Barang</h3>
            <a href="#" class="btn btn-primary my-3 width-100">Tambah Data Jenis Barang</a>
            <div class="input-group my-3">
                <input type="text" class="form-control" placeholder="Cari Data Berdasarkan Jenis Barang" aria-describedby="button-addon2" />
                <button class="btn btn-outline-primary" type="button" id="button-addon2">Cari!!!</button>
            </div>
            <div class="overflow-auto">
                <table class="table table-bordered">
                    <thead class="table-info">
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Jenis Barang</th>
                            <th colspan="2" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($datajenisbarang as $datajenisbarangsatuan) : ?>
                        <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td><?= $datajenisbarangsatuan["jenis_barang"] ?></td>
                            <td class="text-center"><button type="button" class="btn btn-warning">Edit</button></td>
                            <td class="text-center"><button type="button" class="btn btn-danger">Delete</button></td>
                        </tr>
                        <?php $i++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container-custom" id="datapembayaran">
            <div class="to-bottom"></div>
            <h3 class="text-center mb-3">Data Layanan Pembayaran</h3>
            <a href="#" class="btn btn-primary my-3 width-100">Tambah Data Pembayaran</a>
            <div class="input-group my-3">
                <input type="text" class="form-control" placeholder="Cari Data Pembayaran Berdasarkan Nama Pembayaran" aria-describedby="button-addon2" />
                <button class="btn btn-outline-primary" type="button" id="button-addon2">Cari!!!</button>
            </div>
            <div class="overflow-auto">
                <table class="table table-bordered">
                    <thead class="table-info">
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama Pembayaran</th>
                            <th colspan="2" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($datapembayaran as $datapembayaransatuan) : ?>
                        <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td><?= $datapembayaransatuan["nama_pembayaran"] ?></td>
                            <td class="text-center"><button type="button" class="btn btn-warning">Edit</button></td>
                            <td class="text-center"><button type="button" class="btn btn-danger">Delete</button></td>
                        </tr>
                        <?php $i++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="container-custom" id="databarang">
            <div class="to-bottom"></div>
            <h3 class="text-center mb-3">Data Barang</h3>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Data Berdasarkan Nama Barang atau Jenis Barang atau Merek Barang" aria-describedby="button-addon2" />
                <button class="btn btn-outline-primary" type="button" id="button-addon2">Cari!!!</button>
            </div>
            <div class="overflow-auto">
                <table class="table table-bordered">
                    <thead class="table-info">
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Foto Barang</th>
                            <th scope="col">Nama Toko</th>
                            <th scope="col">Username</th>
                            <th scope="col">Merek Barang</th>
                            <th scope="col">Jenis Barang</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($databaranglengkap as $databaranglengkapsatuan) : ?>
                            <tr>
                                <td class="text-center"><?= $i ?></td>
                                <td><?= $databaranglengkapsatuan["nama_barang"] ?></td>
                                <td class="text-center"><img width="100" height="100" src="../img/fotobarang/<?= $databaranglengkapsatuan["foto_barang"] ?>" /></td>
                                <td><?= $databaranglengkapsatuan["nama_toko"] ?></td>
                                <td><?= $databaranglengkapsatuan["fk_username"] ?></td>
                                <td><?= $databaranglengkapsatuan["merek"] ?></td>
                                <td><?= $databaranglengkapsatuan["jenis_barang"] ?></td>
                                <td><?= $databaranglengkapsatuan["stok"] ?></td>
                                <td><?= $databaranglengkapsatuan["harga"] ?></td>
                                <td class="text-center"><a href="hapusdatabarang.php?id_barang=<?= $databaranglengkapsatuan["id_barang"] ?>" class="btn btn-danger">Delete</a></td>
                                <?php $i++; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="../js/custom.js"></script>
        <script>
            alert('Yang bisa bekerja hanya delete barang saja\nSisanya tahap pembuatan');
        </script>
    </body>
</html>
