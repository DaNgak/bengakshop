<?php 

    $conn = mysqli_connect("localhost", "root", "", "bengakshop");
    
    function queryarray ($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $tampungdata = [];
        while ( $row = mysqli_fetch_assoc($result) ) {
            $tampungdata[] = $row;
        }
        return $tampungdata;
    }

    function registrasiuser($datauser){
        global $conn;

        $username = strtolower(stripcslashes(htmlspecialchars($datauser["username"])));
        $email = strtolower(stripcslashes(htmlspecialchars($datauser["email"])));
        $password = mysqli_real_escape_string($conn, $datauser["password"]);
        $password2 = mysqli_real_escape_string($conn, $datauser["confirmpassword"]);
        
        // Cek apakah username dan email sudah ada pada database atau belum
        $result = mysqli_query($conn, "SELECT username FROM data_user WHERE username='$username'");
        if(mysqli_fetch_assoc($result)){
            echo "<script>
                alert('Username Sudah Terdaftar!!!');
            </script>";
            return false;
        }

        // Cek Email
        $result = mysqli_query($conn, "SELECT email FROM data_user WHERE email='$email'");
        if(mysqli_fetch_assoc($result)){
            echo "<script>
                alert('Email Sudah Terdaftar!!!');
            </script>";
            return false;
        }

        // Cek apakah password dan confirm password sama atau beda
        if ( $password != $password2 ) {
            echo "<script>
                alert('Password dan Confirm Password Berbeda!!!');
            </script>";
            return false;
        }

        $queryinsert = "INSERT INTO data_user (
                            username, 
                            email, 
                            password,
                            fk_id_akses
                            )
                        VALUES ('$username', '$email', '$password', 3)";
        mysqli_query($conn, $queryinsert);
        return mysqli_affected_rows($conn);
    }

    function loginuser($row){
        if ($row) {
            if($row["username"] === $username && $row["password"] === $password){
                echo "<script>
                    alert('Login Berhasil!!!');
                </script>";
                $_SESSION["loginpembeli"] = 'true';
                $_SESSION["username"] = $username;
                return true;
            }
        }
        return false;
    }

    function registrasiseller($dataseller, $username){
        global $conn;

        $namatoko = htmlspecialchars($dataseller["namatoko"]);
        $kota = htmlspecialchars($dataseller["kabupatenkota"]);
        $propinsi = htmlspecialchars($dataseller["proponsi"]);
        $nikktp = htmlspecialchars($dataseller["nikktp"]);
        $fotoktp = uploadfotoktp();

        if ( !$fotoktp ) {
            return false;
        }
        
        // Cek apakah nama toko sudah ada atau belum
        $result = mysqli_query($conn, "SELECT nama_toko FROM data_penjual WHERE nama_toko='$namatoko'");
        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                alert('Nama Toko Sudah Terdaftar!!!');
            </script>";
            return false;
        }

        // Cek apakah nikktp 16 angka
        if ( strlen($nikktp) != 16 ){
            echo "<script>
                alert('Panjang NIK KTP Tidak Valid (Harus 16 Angka)!!!');
            </script>";
            return false;
        }

        // Cek apakah nik sudah ada atau belum
        $result = mysqli_query($conn, "SELECT nik FROM data_penjual WHERE nik='$nikktp'");
        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                alert('NIK KTP Sudah Terdaftar!!!');
            </script>";
            return false;
        }

        $queryinsert = "INSERT INTO data_penjual (
            nama_toko,
            foto_ktp,
            nik,
            kota,
            propinsi,
            fk_username
        ) VALUES ('$namatoko', '$fotoktp', '$nikktp', '$kota', '$propinsi', '$username')";

        mysqli_query($conn, $queryinsert);

        return mysqli_affected_rows($conn);
    }

    function tambahdatabarang($databarang){
        global $conn;

        $namatoko = $databarang["namatoko"];
        $namabarang = htmlspecialchars($databarang["namabarang"]);
        $merekbarang = htmlspecialchars($databarang["merekbarang"]);
        $jenisbarang = htmlspecialchars($databarang["jenisbarang"]);
        $stokbarang = htmlspecialchars($databarang["stokbarang"]);
        $hargabarang = htmlspecialchars($databarang["hargabarang"]);
        $deskripsibarang = htmlspecialchars($databarang["deskripsibarang"]);
        $fotobarang = uploadfotobarang();
        if (!$fotobarang) {
            return false;
        }

        $queryinsert = "INSERT INTO barang (
                            id_barang, 
                            nama_barang, 
                            foto_barang, 
                            deskripsi_barang, 
                            merek, 
                            stok, 
                            harga, 
                            fk_id_jenis_barang, 
                            fk_nama_toko) 
                        VALUES ( NULL, '$namabarang', '$fotobarang', '$deskripsibarang', 
                            '$merekbarang', $stokbarang, $hargabarang, $jenisbarang, '$namatoko'
                        )";

        mysqli_query($conn, $queryinsert);

        return mysqli_affected_rows($conn);
    }

    function updatedataprofiletoko($dataprofiletoko){
        global $conn;
        $namatoko = $dataprofiletoko["namatoko"];
        $username = $dataprofiletoko["username"];
        $kota = htmlspecialchars($dataprofiletoko["kabupatenkota"]);
        $propinsi = htmlspecialchars($dataprofiletoko["propinsi"]);
        $deskripsitoko = htmlspecialchars($dataprofiletoko["deskripsitoko"]);
        $fotoprofiletokolama = htmlspecialchars($dataprofiletoko["profiletokolama"]);

        if ( $_FILES["profiletoko"]["error"] === 4 ) {
            $fotoprofiletokobaru = $fotoprofiletokolama;
        } else {
            $fotoprofiletokobaru = uploadfotoprofiletoko();
        }

        $queryupdate = "UPDATE data_penjual 
                        SET 
                            kota='$kota',
                            propinsi='$propinsi',
                            deskripsi_toko='$deskripsitoko',
                            foto_toko='$fotoprofiletokobaru'
                        WHERE nama_toko='$namatoko' AND fk_username='$username'";

        mysqli_query($conn, $queryupdate);
        return mysqli_affected_rows($conn);
        
    }

    function updateaksesuser ($username){
        global $conn;

        $queryupdate = "UPDATE data_user 
                        SET fk_id_akses = 2 
                        WHERE username = '$username'";
        
        mysqli_query($conn, $queryupdate);

        return mysqli_affected_rows($conn);
    }

    function updatedatabarang($databarang){
        global $conn;

        $namaproduct = htmlspecialchars($databarang["namaproduct"]);
        $merekproduct = htmlspecialchars($databarang["merekproduct"]);
        $jenisproduct = htmlspecialchars($databarang["jenisproduct"]);
        $stokproduct = htmlspecialchars($databarang["stokproduct"]);
        $hargaproduct = htmlspecialchars($databarang["hargaproduct"]);
        $deskripsiproduct = htmlspecialchars($databarang["deskripsiproduct"]);
        $idproduct = $databarang["idbarangedit"];
        $gambarproductlama = $databarang["gambarproductbarangedit"];
        
        if ( $_FILES["fotoproductbarang"]["error"] === 4 ) {
            $gambarproductbaru = $gambarproductlama;
        } else {
            $gambarproductbaru = uploadfotobarang();
        }
        
        $queryupdate = "UPDATE barang SET 
                            nama_barang='$namaproduct',
                            foto_barang='$gambarproductbaru',
                            merek='$merekproduct',
                            fk_id_jenis_barang='$jenisproduct',
                            deskripsi_barang='$deskripsiproduct',
                            stok=$stokproduct,
                            harga=$hargaproduct
                        WHERE id_barang=$idproduct";

        mysqli_query($conn, $queryupdate);
        
        return mysqli_affected_rows($conn);
    }

    function updatedatauser($datauser){ 
        global $conn;

        $username = $datauser["username"];
        $passworduser = mysqli_real_escape_string($conn, $datauser["password"]);
        $fotoprofileuserlama = $datauser["fotoprofiluserlama"];

        if ( $_FILES["fotoprofileuser"]["error"] === 4 ) {
            $fotoprofileuserbaru = $fotoprofileuserlama;
        } else {
            $fotoprofileuserbaru = uploadfotoprofileuser();
        }

        $queryupdate = "UPDATE data_user SET 
                            password='$passworduser', 
                            foto_profil='$fotoprofileuserbaru'
                        WHERE username='$username'";

        mysqli_query($conn, $queryupdate);

        return mysqli_affected_rows($conn);
    }

    function uploadfotoktp(){
        $namafiles = $_FILES["fotoktp"]["name"];
        $sizefiles = $_FILES["fotoktp"]["size"];
        $error = $_FILES["fotoktp"]["error"];
        $tmpfiles = $_FILES["fotoktp"]["tmp_name"];

        // Cek apakah ada gambar yang di upload
        if ( $error === 4 ) {
            echo "<script>
                alert('Masukkan Gambar Terlebih Dahulu');
            </script>";
            return false;
        }

        // Cek apakah yang di upload adalah gambar
        $ekstensigambarvalid = ['jpg', 'jpeg', 'png', 'jfif'];
        $ekstensigambar = explode('.', $namafiles);
        $ekstensigambarupload = strtolower(end($ekstensigambar));
        if ( !in_array($ekstensigambarupload, $ekstensigambarvalid) ){
            echo "<script>
                alert('Yang Anda Upload Bukan Gambar Gunakan Format jpg, jpeg, png, jfif');
            </script>";
            return false;
        }

        // Cek ukuran file lebih besar dari 2 mb
        if ( $sizefiles > 2000000) {
            echo "<script>
                alert('Size Gambar Anda Terlalu Besar MAX 2 MB');
            </script>";
            return false;
        }

        move_uploaded_file($tmpfiles, "../img/fotoktppenjual/" . $namafiles);

        return $namafiles;
    }

    function uploadfotoprofiletoko(){
        $namafiles = $_FILES["profiletoko"]["name"];
        $sizefiles = $_FILES["profiletoko"]["size"];
        $error = $_FILES["profiletoko"]["error"];
        $tmpfiles = $_FILES["profiletoko"]["tmp_name"];

        // Cek apakah ada gambar yang diupload
        if ( $error === 4 ) {
            echo "<script>
                alert('Masukkan Gambar Terlebih Dahulu');
            </script>";
            return false;
        }

        // Cek apakah yang di upload adalah gambar atau bukan
        $ekstensigambarvalid = ['jpg', 'jpeg', 'png', 'jfif'];
        $ekstensigambar = explode('.',  $namafiles);
        $ekstensigambarupload = strtolower(end($ekstensigambar));
        if ( !in_array($ekstensigambarupload, $ekstensigambarvalid) ) {
            echo "<script>
                alert('Yang Anda Upload Bukan Gambar Gunakan Format jpg, jpeg, png, jfif');
            </script>";
            return false;
        }

        // Cek Ukuran File lebih dari 2mb
        if ( $sizefiles > 2000000) {
            echo "<script>
                alert('Size Gambar Anda Terlalu Besar MAX 2 MB');
            </script>";
            return false;
        }

        move_uploaded_file($tmpfiles, "../img/fotoprofiletoko/" . $namafiles);

        return $namafiles;
    }

    function uploadfotobarang(){
        $namefiles = $_FILES["fotoproductbarang"]["name"];
        $sizefiles = $_FILES["fotoproductbarang"]["size"];
        $error = $_FILES["fotoproductbarang"]["error"];
        $tmpfiles = $_FILES["fotoproductbarang"]["tmp_name"];

        // Cek apakah ada gambar diupload atau tidak
        if ( $error === 4 ) {
            echo "<script>
                alert('Masukkan Gambar Terlebih Dahulu');
            </script>";
            return false;
        }

        // Cek Ekstensi File yang di upload
        $ekstensigambarvalid = ['jpg', 'jpeg', 'png', 'jfif'];
        $ekstensigambar = explode('.', $namefiles);
        $ekstensigambarupload = strtolower(end($ekstensigambar));
        if ( !in_array($ekstensigambarupload, $ekstensigambarvalid) ) {
            echo "<script>
                alert('Yang Anda Upload Bukan Gambar Gunakan Format jpg, jpeg, png, jfif');
            </script>";
            return false;
        }

        // Cek Besar File yang di upload Max 2 MB
        if ( $sizefiles > 2000000 ) {
            echo "<script>
                alert('Size Gambar Anda Terlalu Besar MAX 2 MB');
            </script>";
            return false;
        }

        move_uploaded_file($tmpfiles, "../img/fotobarang/" . $namefiles);
        return $namefiles;
    }

    function uploadfotoprofileuser(){
        $namefiles = $_FILES["fotoprofileuser"]["name"];
        $sizefiles = $_FILES["fotoprofileuser"]["size"];
        $error = $_FILES["fotoprofileuser"]["error"];
        $tmpfiles = $_FILES["fotoprofileuser"]["tmp_name"];

        // Cek apakah ada gambar diupload atau tidak
        if ( $error === 4 ) {
            echo "<script>
                alert('Masukkan Gambar Terlebih Dahulu');
            </script>";
            return false;
        }

        // Cek Ekstensi File yang di upload
        $ekstensigambarvalid = ['jpg', 'jpeg', 'png', 'jfif'];
        $ekstensigambar = explode('.', $namefiles);
        $ekstensigambarupload = strtolower(end($ekstensigambar));
        if ( !in_array($ekstensigambarupload, $ekstensigambarvalid) ) {
            echo "<script>
                alert('Yang Anda Upload Bukan Gambar Gunakan Format jpg, jpeg, png, jfif');
            </script>";
            return false;
        }

        // Cek Besar File yang di upload Max 2 MB
        if ( $sizefiles > 2000000 ) {
            echo "<script>
                alert('Size Gambar Anda Terlalu Besar MAX 2 MB');
            </script>";
            return false;
        }

        move_uploaded_file($tmpfiles, "img/fotoprofileuser/" . $namefiles);
        return $namefiles;
    }

    function hapusdatabarang($idbarang){
        global $conn;

        $querydelete = "DELETE FROM barang WHERE id_barang=$idbarang";

        mysqli_query($conn, $querydelete);

        return mysqli_affected_rows($conn);
    }

    function hapusdatapembeli($username){
        global $conn;

        // Hapus Depedency / Ketergantungan nya dulu
        // if (hapusdatapembeliditabelpembelian($username) > 0) {
            
        // } else {
        //     return false;
        // }

        $querydelete = "DELETE FROM data_user WHERE username='$username'";

        mysqli_query($conn, $querydelete);

        return mysqli_affected_rows($conn);
    }

    function hapusdatapembeliditabelpembelian($username){
        global $conn;

        $querydelete = "DELETE FROM pembelian WHERE username='$username'";

        mysqli_query($conn, $querydelete);

        return mysqli_affected_rows($conn);
    }

    function hapusdatapenjual($username, $namatoko){
        global $conn;

        // Hapus Depedency / Ketergantungan nya dulu
        if (hapusdatapenjualditabelbarang($namatoko) > 0) {
            
        } else {
            return false;
        }

        if (hapusdatapenjualditabeldatapenjual($namatoko) > 0) {
            
        } else {
            return false;
        }

        $querydelete = "DELETE FROM data_user WHERE username='$username'";

        mysqli_query($conn, $querydelete);

        return mysqli_affected_rows($conn);
    }
    
    function hapusdatapenjualditabeldatapenjual($namatoko){
        global $conn;

        $querydelete = "DELETE FROM data_penjual WHERE nama_toko='$namatoko'";

        mysqli_query($conn, $querydelete);

        return mysqli_affected_rows($conn);
    }

    function hapusdatapenjualditabelbarang($namatoko){
        global $conn;

        $querydelete = "DELETE FROM barang WHERE fk_nama_toko='$namatoko'";

        mysqli_query($conn, $querydelete);

        return mysqli_affected_rows($conn);
    }

?>