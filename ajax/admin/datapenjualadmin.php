<?php 

    session_start();

    if ( !isset($_SESSION["username"]) ){ 
        header("Location: ../../login.php");
        exit;
    }

    if ( !isset($_GET["keywordcaridatapenjual"]) ){ 
        header("Location: ../../admin/homeadmin.php");
        exit;
    }

    require "../../allfunctions.php";

    $keywordcari = $_GET["keywordcaridatapenjual"];

    // Data Penjual
    $query = "SELECT 
        dp.kota,
        dp.propinsi,
        dp.nik,
        dp.nama_toko,
        username,
        password, 
        email,
        fk_id_akses
    FROM data_user du 
    INNER JOIN data_penjual dp on dp.fk_username = du.username
    WHERE 
        fk_id_akses=2 AND
        (username LIKE '$keywordcari%' OR 
        email LIKE '%$keywordcari%' OR 
        nama_toko LIKE '$keywordcari%' OR 
        nik LIKE '$keywordcari%')";
    $datapenjual = queryarray($query);
    
?>

<?php if($datapenjual) : ?>
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
<?php else : ?>
    <h1 class="text-center my-3">Data Penjual <?= $keywordcari ?> Tidak Ditemukan</h1>
<?php endif; ?>