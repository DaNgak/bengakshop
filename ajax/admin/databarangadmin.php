<?php 

    session_start();

    if ( !isset($_SESSION["username"]) ){ 
        header("Location: ../../login.php");
        exit;
    }

    if ( !isset($_GET["keywordcaridatabarang"]) ){ 
        header("Location: ../../admin/homeadmin.php");
        exit;
    }

    require "../../allfunctions.php";

    $keywordcari = $_GET["keywordcaridatabarang"];

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
    INNER JOIN data_penjual dp ON dp.nama_toko = b.fk_nama_toko
    WHERE 
        nama_barang LIKE '%$keywordcari%' OR 
        jenis_barang LIKE '$keywordcari%' OR 
        nama_toko LIKE '$keywordcari%' OR 
        merek LIKE '$keywordcari%'";
    $databaranglengkap = queryarray($query);

?>



<?php if($databaranglengkap) : ?>
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
<?php else : ?>
    <h1 class="text-center my-3">Data Barang <?= $keywordcari ?> Tidak Ditemukan</h1>
<?php endif; ?>