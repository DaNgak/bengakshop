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

    $query = "SELECT * FROM jenis_barang";
    $datajenisbarang = queryarray($query);

    if ( isset($_POST["submitdataproduct"]) ) {
        if ( tambahdatabarang($_POST) > 0 ) {
            echo "<script>
                alert('Data Barang Berhasil Ditambahkan');
                document.location.href = 'homepenjual.php#dataproduksaya';
            </script>";
        } else {
            echo "<script>
                alert('Data Barang Gagal Ditambahkan');
            </script>";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../css/customstyle.css" />
        <title>Edit Data Product</title>
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
                height: 350px;
                text-align: justify;
            }

            .image-kosong {
                border: 1px solid black;
            }
        </style>
    </head>
    <body class="width-100">
        <section class="container-custom mx-auto">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="namatoko" value="<?= $_SESSION['nama_toko'] ?>">
                <div class="row text-center mt-2 mb-5">
                    <h1 class="my-3">Tambah Data Product</h1>
                    <p>
                        <a class="btn btn-primary mx-5" href="homepenjual.php">Kembali Dari Home Seller</a>
                    </p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="row align-items-center input-group">
                            <div class="col-md-4 align-items-center">
                                <label class="input-group-text" for="namabarang">Nama Product</label>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <input type="text" autofocus="" class="form-control" name="namabarang" id="namabarang" required />
                            </div>
                        </div>
                        <div class="row align-items-center input-group my-4">
                            <div class="col-md-4 align-items-center">
                                <label class="input-group-text" for="gambarproduct">Foto Product</label>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <input type="file" class="form-control" name="fotoproductbarang" id="gambarproduct" required />
                            </div>
                        </div>
                        <div class="row align-items-center input-group my-4">
                            <div class="col-md-4 align-items-center">
                                <label class="input-group-text" for="merekbarang">Merek Product</label>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <input type="text" class="form-control" name="merekbarang" id="merekbarang" required />
                            </div>
                        </div>
                        <div class="row align-items-center input-group my-4">
                            <div class="col-md-4 align-items-center">
                                <label class="input-group-text" for="">Jenis Product</label>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <select name="jenisbarang" class="form-select" aria-label="Default select example" required>
                                    <?php foreach($datajenisbarang as $datajenisbarangsatuan) : ?>
                                        <option value="<?= $datajenisbarangsatuan["id_jenis_barang"] ?>"><?= $datajenisbarangsatuan["jenis_barang"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center input-group my-4">
                            <div class="col-md-4 align-items-center">
                                <label class="input-group-text" for="stokbarang">Stok Product</label>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <input type="number" class="form-control" name="stokbarang" id="stokbarang" required />
                            </div>
                        </div>
                        <div class="row align-items-center input-group my-4">
                            <div class="col-md-4 align-items-center">
                                <label class="input-group-text" for="hargabarang">Harga Product</label>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <input type="number" class="form-control" name="hargabarang" id="hargabarang" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row input-group">
                            <div class="col-md-12 align-items-center">
                                <label class="input-group-text" for="deskripsibarang">Deskripsi Product</label>
                                <textarea class="form-control deskripsi-product" name="deskripsibarang" id="deskripsibarang" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center my-5">
                    <div class="col-md-12">
                        <button class="btn btn-info px-3" type="submit" name="submitdataproduct">Tambah Data Product</button>
                    </div>
                </div>
            </form>
        </section>
        <script src="../js/custom.js"></script>
    </body>
</html>
