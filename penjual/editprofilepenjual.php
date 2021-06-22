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

    if ( isset($_POST["submit"]) ){
        if ( updatedataprofiletoko($_POST) > 0 ) {
            echo "<script>
                alert('Update Profile Toko Berhasil!!!');
                document.location.href = 'homepenjual.php#profile-penjual';
            </script>";
        } else {
            echo "<script>
                alert('Profile Toko Gagal Diubah');
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
        <title>Edit Data Penjual</title>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap");
            body {
                font-family: "Poppins", sans-serif;
                background-color: ghostwhite;
            }
            .container-custom {
                width: 95%;
            }
            nav {
                z-index: 3;
            }

            .width-100 {
                width: 100%;
            }

            .z-indexminus {
                z-index: -1;
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
            }
        </style>
    </head>
    <body>
        <section class="d-flex justify-content-center align-items-center" id="profile-penjual">
            <div class="container-md">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="namatoko" value="<?= $dataprofilepenjual["nama_toko"] ?>">
                    <input type="hidden" name="profiletokolama" value="<?= $dataprofilepenjual["foto_toko"] ?>">
                    <input type="hidden" name="username" value="<?= $dataprofilepenjual["username"] ?>">
                    <div class="row">
                        <div class="col-md my-4 text-center">
                            <h1 class="mb-4">Edit Data Penjual</h1>
                            <p>
                                <a class="btn btn-primary" href="homepenjual.php">Kembali Ke Home Seller</a>
                            </p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="align-items-center text-center">
                                <span class="form-control">Foto Profile Toko</span>
                            </div>
                            <img src="../img/fotoprofiletoko/<?= $dataprofilepenjual["foto_toko"] ?>" class="rounded mx-auto my-3 d-block" alt="Profile Toko <?= $dataprofilepenjual["nama_toko"] ?>" width="250" height="250" />
                            <div class="input-group">
                                <label class="input-group-text" for="fotoprofileseller">Edit</label>
                                <input type="file" name="profiletoko" value="<?= $dataprofilepenjual["foto_toko"] ?>" class="form-control" id="fotoprofileseller" />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row align-items-center mb-4">
                                <div class="col-md-3 align-items-center">
                                    <span class="input-group-text">NIK KTP</span>
                                </div>
                                <div class="col-md-9 align-items-center">
                                    <span class="form-control"><?= $dataprofilepenjual["nik"] ?></span>
                                </div>
                            </div>
                            <div class="row align-items-center my-4">
                                <div class="col-md-3 align-items-center">
                                    <span class="input-group-text">Username</span>
                                </div>
                                <div class="col-md-9 align-items-center">
                                    <span class="form-control"><?= $dataprofilepenjual["username"] ?></span>
                                </div>
                            </div>
                            <div class="row align-items-center my-4">
                                <div class="col-md-3 align-items-center">
                                    <label class="input-group-text" for="">Nama Toko</label>
                                </div>
                                <div class="col-md-9 align-items-center">
                                    <span class="form-control"><?= $dataprofilepenjual["nama_toko"] ?></span>
                                </div>
                            </div>
                            <div class="row align-items-center my-4">
                                <div class="col-md-3 align-items-center">
                                    <label class="input-group-text" for="">Email </label>
                                </div>
                                <div class="col-md-9 align-items-center">
                                <span class="form-control"><?= $dataprofilepenjual["email"] ?></span>
                                </div>
                            </div>
                            <div class="row align-items-center my-4">
                                <div class="col-md-3 align-items-center">
                                    <label class="input-group-text" for="kabupatenkota">Kabupaten/Kota </label>
                                </div>
                                <div class="col-md-9 align-items-center">
                                    <input type="text" class="form-control" value="<?= $dataprofilepenjual["kota"] ?>" name="kabupatenkota" id="kabupatenkota" autofocus="" required />
                                </div>
                            </div>
                            <div class="row align-items-center my-4">
                                <div class="col-md-3 align-items-center">
                                    <label class="input-group-text" for="propinsi">Propinsi</label>
                                </div>
                                <div class="col-md-9 align-items-center">
                                    <input type="text" class="form-control" value="<?= $dataprofilepenjual["propinsi"] ?>" name="propinsi" id="propinsi" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 align-items-center">
                            <label class="input-group-text" for="deskripsitoko">Deskripsi Toko</label>
                        </div>
                        <div class="col-md-10 align-items-center">
                            <textarea class="form-control deskripsi-toko" id="deskripsitoko" name="deskripsitoko" required><?= $dataprofilepenjual["deskripsi_toko"] ?></textarea>
                        </div>
                    </div>
                    <div class="row text-center my-4">
                        <div class="col-md-12">
                            <button class="btn btn-info" type="submit" name="submit">Ubah Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <script src="../js/custom.js"></script>
    </body>
</html>
