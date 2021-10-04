<?php 

    session_start();
    if ( !isset($_SESSION["username"]) ){ 
        header("Location: login.php");
        exit;
    }

    if ( !isset($_GET["keywoarddatacari"]) ) {
        header("Location: index.php");
        exit;
    }

    require "../allfunctions.php";

    $datacari = $_GET["keywoarddatacari"];

    $query = "SELECT 
                nama_barang, 
                foto_barang, 
                jb.jenis_barang,
                harga
            FROM barang b
            INNER JOIN jenis_barang jb ON jb.id_jenis_barang = b.fk_id_jenis_barang
            WHERE nama_barang LIKE '%$datacari%' OR jenis_barang LIKE '$datacari%'";
    
    $databarang = queryarray($query);

?>

<?php if($databarang) : ?>
    <?php foreach($databarang as $databarangsatuan) : ?>
        <div class="glass3 product">
            <a href="#" id="product-click">
                <div class="product-top">
                    <div class="product-image"><img width="170" height="170" src="img/fotobarang/<?= $databarangsatuan["foto_barang"]; ?>" alt="<?= $databarangsatuan["nama_barang"]; ?>" /></div>
                    <div class="product-title"><?= $databarangsatuan["nama_barang"] ?></div>
                </div>
                <div class="product-bottom">
                    <div class="product-kind"><?= $databarangsatuan["jenis_barang"] ?></div>
                    <div class="product-price"><?= $databarangsatuan["harga"] ?></div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <h1>Data Barang <?= $datacari ?> Tidak Ditemukan</h1>
<?php endif; ?>