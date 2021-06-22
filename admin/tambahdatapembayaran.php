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


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../css/customstyle.css" />
        <title>Tambah Data Pembayaran</title>
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
            .form-label {
                text-indent: 20px;
            }
            div.container a.btn-primary.my-3.home {
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class="container my-5">
            <div class="text-center mb-3">
                <h1>Tambah Data Barang</h1>
                <a class="btn btn-primary my-3" href="homeadmin.php">Kembali ke Home</a>
            </div>
            <form>
                <div class="mb-3">
                    <label for="usernamepenjual" class="form-label">Username Penjual</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="usernamepenjual" required />
                        <button type="submit" class="btn btn-outline-primary" id="button-addon2">Cek Ketersediaan Username</button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="namabarang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="namabarang" required />
                </div>
                <div class="mb-3">
                    <label for="fotobarang" class="form-label">Foto Barang</label>
                    <input type="text" class="form-control" id="fotobarang" required />
                </div>
                <div class="mb-3">
                    <label for="merekbarang" class="form-label">Merek Barang</label>
                    <input type="text" class="form-control" id="merekbarang" required />
                </div>
                <div class="mb-3">
                    <label for="jenisbarang" class="form-label">Jenis Barang</label>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="jenisbarang">Pilih Jenis Barang</label>
                        <select class="form-select" id="jenisbarang" required>
                            <option selected value="1">Celana</option>
                            <option value="2">Hoodie</option>
                            <option value="3">Kaos</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="deskripsibarang" class="form-label">Deskripsi Barang</label>
                    <textarea class="form-control" name="" id="deskripsibarang" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="stokbarang" class="form-label">Stok Barang</label>
                    <input type="number" class="form-control" id="stokbarang" required />
                </div>
                <div class="mb-3">
                    <label for="hargabarang" class="form-label">Harga Barang</label>
                    <input type="number" class="form-control" id="hargabarang" required />
                </div>
                <div class="col-12 d-flex justify-content-end my-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <script src="../js/custom.js"></script>
    </body>
</html>
