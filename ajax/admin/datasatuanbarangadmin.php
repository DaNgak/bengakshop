<?php 

    session_start();

    if ( !isset($_SESSION["username"]) ){ 
        header("Location: ../../login.php");
        exit;
    }

    if ( !isset($_GET["keywordcaridatasatuan"]) ){ 
        header("Location: ../../admin/homeadmin.php");
        exit;
    }

    require "../../allfunctions.php";

    $keywordcari = $_GET["keywordcaridatasatuan"];

    // Data Satuan Barang
    $query = "SELECT * FROM satuan_barang WHERE nama_satuan LIKE '$keywordcari%'";
    $datasatuanbarang = queryarray($query);

?>

<?php if($datasatuanbarang) : ?>
    <table class="table table-bordered">
        <thead class="table-info">
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Nama Satuan Barang</th>
                <th scope="col">Total Barang</th>
                <th colspan="2" scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach($datasatuanbarang as $datasatuanbarangsatuan) : ?>
            <tr>
                <td class="text-center"><?= $i ?></td>
                <td><?= $datasatuanbarangsatuan["nama_satuan"] ?></td>
                <td><?= $datasatuanbarangsatuan["jumlah_barang"] ?></td>
                <td class="text-center"><button type="button" class="btn btn-warning">Edit</button></td>
                <td class="text-center"><button type="button" class="btn btn-danger">Delete</button></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach ?>
        </tbody>
    </table>
<?php else : ?>
    <h1 class="text-center my-3">Data Satuan Barang <?= $keywordcari ?> Tidak Ditemukan</h1>
<?php endif; ?>