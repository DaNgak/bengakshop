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

    if ( !isset($_GET["id_barang"]) ) {
        header("Location: homepenjual.php");
        exit;
    }

    $idbarang = $_GET["id_barang"];

    $query = "SELECT 
                *, 
                jb.jenis_barang 
            FROM barang b
            INNER JOIN jenis_barang jb ON jb.id_jenis_barang = b.fk_id_jenis_barang
            WHERE id_barang=$idbarang";            
    $databaranglengkap = queryarray($query)[0];

    $query = "SELECT * FROM jenis_barang";
    $datajenisbarang = queryarray($query);

    if ( isset($_POST["submit"]) ){
        if ( updatedatabarang($_POST) > 0 ) {
            echo "<script>
                alert('Data Product Berhasil Dirubah');
                document.location.href = 'detaildataproduct.php?id_barang=$idbarang';
            </script>";
        } else {
            echo "<script>
                alert('Data Product Gagal Dirubah');
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
                width: 100%;
                overflow-x: hidden !important;
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
        </style>
    </head>
    <body>
        <section class="container-custom mx-auto">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="gambarproductbarangedit" value="<?= $databaranglengkap["foto_barang"] ?>">
                <input type="hidden" name="idbarangedit" value="<?= $idbarang ?>">
                <div class="row text-center mt-2 mb-5">
                    <h1 class="my-3">Edit Data Product</h1>
                    <p>
                        <a class="btn btn-primary mx-5" href="detaildataproduct.php?id_barang=<?= $idbarang ?>">Kembali Dari Edit Data</a>
                    </p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="align-items-center text-center">
                            <span class="form-control">Foto Product</span>
                        </div>
                        <img src="../img/fotobarang/<?= $databaranglengkap["foto_barang"] ?>" class="rounded mx-auto my-3 d-block" alt="Foto Product <?= $databaranglengkap["nama_barang"] ?>" width="250" height="250" />
                        <div class="input-group">
                            <label class="input-group-text" for="fotoproduct">Edit</label>
                            <input type="file" value="<?= $databaranglengkap["foto_barang"] ?>" class="form-control" name="fotoproductbarang" id="fotoproduct" />
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row align-items-center input-group">
                            <div class="col-md-4 align-items-center">
                                <span class="input-group-text">ID Product</span>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <span class="form-control"><?= $databaranglengkap["id_barang"] ?></span>
                            </div>
                        </div>
                        <div class="row align-items-center input-group my-4">
                            <div class="col-md-4 align-items-center">
                                <label class="input-group-text" for="namaproduct">Nama Product</label>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <input type="text" autofocus="" class="form-control" value="<?= $databaranglengkap["nama_barang"] ?>" name="namaproduct" id="namaproduct" required />
                            </div>
                        </div>
                        <div class="row align-items-center input-group my-4">
                            <div class="col-md-4 align-items-center">
                                <label class="input-group-text" for="merekproduct">Merek Product</label>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <input type="text" class="form-control" value="<?= $databaranglengkap["merek"] ?>" name="merekproduct" id="merekproduct" required />
                            </div>
                        </div>
                        <div class="row align-items-center input-group my-4">
                            <div class="col-md-4 align-items-center">
                                <label class="input-group-text" for="">Jenis Product</label>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <select name="jenisproduct" class="form-select" required>
                                <option selected value="<?= $databaranglengkap["fk_id_jenis_barang"] ?>"><?= $databaranglengkap["jenis_barang"] ?></option>
                                    <?php foreach($datajenisbarang as $datajenisbarangsatuan) : ?>
                                        <?php if($datajenisbarangsatuan["id_jenis_barang"] != $databaranglengkap["fk_id_jenis_barang"]) : ?>
                                            <option value="<?= $datajenisbarangsatuan["id_jenis_barang"] ?>"><?= $datajenisbarangsatuan["jenis_barang"] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center input-group my-4">
                            <div class="col-md-4 align-items-center">
                                <label class="input-group-text" for="stokproduct">Stok Product</label>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <input type="number" class="form-control" value="<?= $databaranglengkap["stok"] ?>" name="stokproduct" id="stokproduct" required />
                            </div>
                        </div>
                        <div class="row align-items-center input-group my-4">
                            <div class="col-md-4 align-items-center">
                                <label class="input-group-text" for="hargaproduct">Harga Product</label>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <input type="number" class="form-control" value="<?= $databaranglengkap["harga"] ?>" name="hargaproduct" id="hargaproduct" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row input-group">
                            <div class="col-md-12 align-items-center">
                                <label class="input-group-text" for="deskripsiproduct">Deskripsi Product</label>
                                <textarea class="form-control deskripsi-product" name="deskripsiproduct" id="deskripsiproduct" required><?= $databaranglengkap["deskripsi_barang"] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center my-5">
                    <div class="col-md-12">
                        <button class="btn btn-info px-3" type="submit" name="submit">Ubah Data Product</button>
                    </div>
                </div>
            </form>
        </section>
        <script src="../js/custom.js"></>
    </body>
</html>
