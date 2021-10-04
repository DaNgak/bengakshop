<?php 

    session_start();

    if ( !isset($_SESSION["username"]) ){ 
        header("Location: ../../login.php");
        exit;
    }

    if ( !isset($_GET["keywordcaridatapembeli"]) ){ 
        header("Location: ../../admin/homeadmin.php");
        exit;
    }

    require "../../allfunctions.php";

    $keywordcari = $_GET["keywordcaridatapembeli"];

    // Data Pembeli
    $query = "SELECT * FROM data_user 
                WHERE fk_id_akses = '3' AND 
                    username LIKE '$keywordcari%'";
    $datapembeli = queryarray($query);
    
?>

<?php if($datapembeli) : ?>
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
<?php else : ?>
    <h1 class="text-center my-3">Data Pembeli <?= $keywordcari ?> Tidak Ditemukan</h1>
<?php endif; ?>