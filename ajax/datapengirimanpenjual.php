<?php 

    session_start();

    if ( !isset($_SESSION["username"]) ){ 
        header("Location: ../login.php");
        exit;
    }

    if ( !isset($_GET["keywordcaridatapemngiriman"]) ){ 
        header("Location: ../homepenjual.php");
        exit;
    }

    require "../allfunctions.php";

    $keywordcari = $_GET["keywordcaridatapemngiriman"];

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
            </tr>
        </thead>
        <tbody>
            <?php $i=1; ?>
            <?php foreach($datapengiriman as $datapengirimansatuan) : ?>
                <tr>
                    <td class="text-center"><?= $i ?></td>
                    <td><?= $datapengirimansatuan["nama_pengiriman"] ?></td>
                    <td><?= $datapengirimansatuan["harga_pengiriman"] ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>    
<?php else : ?>
    <h1 class="text-center my-3">Data Pengiriman <?= $keywordcari ?> Tidak Ditemukan</h1>
<?php endif; ?>
