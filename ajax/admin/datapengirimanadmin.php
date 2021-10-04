<?php 

    session_start();

    if ( !isset($_SESSION["username"]) ){ 
        header("Location: ../../login.php");
        exit;
    }

    if ( !isset($_GET["keywordcaridatapengiriman"]) ){ 
        header("Location: ../../admin/homeadmin.php");
        exit;
    }

    require "../../allfunctions.php";

    $keywordcari = $_GET["keywordcaridatapengiriman"];

    // Data Pengiriman 
    $query = "SELECT * FROM jenis_pengiriman WHERE nama_pengiriman LIKE '$keywordcari%'";
    $datapengiriman = queryarray($query);

?>

<?php if($datapengiriman) : ?>
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
<?php else : ?>
    <h1 class="text-center my-3">Data Pengiriman Barang <?= $keywordcari ?> Tidak Ditemukan</h1>
<?php endif; ?>