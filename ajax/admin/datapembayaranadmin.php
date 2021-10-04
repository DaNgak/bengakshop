<?php 

    session_start();

    if ( !isset($_SESSION["username"]) ){ 
        header("Location: ../../login.php");
        exit;
    }

    if ( !isset($_GET["keywordcaridatapembayaran"]) ){ 
        header("Location: ../../admin/homeadmin.php");
        exit;
    }

    require "../../allfunctions.php";

    $keywordcari = $_GET["keywordcaridatapembayaran"];

    // Data Pembayaran 
    $query = "SELECT * FROM jenis_pembayaran WHERE nama_pembayaran LIKE '$keywordcari%'";
    $datapembayaran = queryarray($query);

?>

<?php if($datapembayaran) : ?>
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
<?php else : ?>
    <h1 class="text-center my-3">Data Pembayaran <?= $keywordcari ?> Tidak Ditemukan</h1>
<?php endif; ?>