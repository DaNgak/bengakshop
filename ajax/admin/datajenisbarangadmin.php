<?php 

    session_start();

    if ( !isset($_SESSION["username"]) ){ 
        header("Location: ../../login.php");
        exit;
    }

    if ( !isset($_GET["keywordcaridatajenisbarang"]) ){ 
        header("Location: ../../admin/homeadmin.php");
        exit;
    }

    require "../../allfunctions.php";

    $keywordcari = $_GET["keywordcaridatajenisbarang"];

    // Data Jenis Barang 
    $query = "SELECT * FROM jenis_barang WHERE jenis_barang LIKE '$keywordcari%'";
    $datajenisbarang = queryarray($query);

?>

<?php if($datajenisbarang) : ?>
    <table class="table table-bordered">
        <thead class="table-info">
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Jenis Barang</th>
                <th colspan="2" scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach($datajenisbarang as $datajenisbarangsatuan) : ?>
            <tr>
                <td class="text-center"><?= $i ?></td>
                <td><?= $datajenisbarangsatuan["jenis_barang"] ?></td>
                <td class="text-center"><button type="button" class="btn btn-warning">Edit</button></td>
                <td class="text-center"><button type="button" class="btn btn-danger">Delete</button></td>
            </tr>
            <?php $i++ ?>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <h1 class="text-center my-3">Data Jenis Barang <?= $keywordcari ?> Tidak Ditemukan</h1>
<?php endif; ?>