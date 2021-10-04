<?php 

    session_start();

    if ( !isset($_SESSION["username"]) ){ 
        header("Location: ../login.php");
        exit;
    }

    if ( !isset($_GET["keywordcaridatabarang"]) ){ 
        header("Location: ../homepenjual.php");
        exit;
    }

    require "../allfunctions.php";

    $keywordcari = $_GET["keywordcaridatabarang"];
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
            WHERE nama_barang LIKE '%$keywordcari%' OR merek LIKE '$keywordcari%' OR jenis_barang LIKE '$keywordcari%'";
    $databarang = queryarray($query);
    $barang=2;

    if($databarang){
        echo "queryok";
    } else {
        echo "query gagal";
    }
    die;
?>



<?php if($barang == 1) : ?>
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
<?php else : ?>
    <h1 class="text-center my-3">Data Barang <?= $keywordcari ?> Tidak Ditemukan</h1>
<?php endif; ?>