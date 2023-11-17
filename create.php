<?php
require 'functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if( create($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'index.php';
            </script>
            ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data obat</title>
</head>
<body>
    <h1>Tambah data Obat</h1>
    <form action="" method="post" enctype="multipart/form-data" > 
        <!-- enctype="multipart/form-data" 
        digunakan untuk mengelola dua type, 
        yaitu string dan file
        (kalau tidak pakai ini, 
        file yg di upload hanya namanya saja yg dikelola 
        dan file itu sendiri tidak dikelola) -->
        <ul>
            <li>
                <label for="nama_obat">Nama Obat: </label>
                <input type="text" name="nama_obat" id="nama_obat" required>
            </li>
            <li>
                <label for="harga_obat">Harga Obat: </label>
                <input type="number" name="harga_obat" id="harga_obat" required>
            </li>
            <li>
                <label for="stok_obat">Stok Obat: </label>
                <input type="number" name="stok_obat" id="stok_obat" required>
            </li>
            <li>
                <label for="jenis_obat">Jenis Obat: </label>
                <input type="text" name="jenis_obat" id="jenis_obat" placeholder="obat keras/bebas/bebas terbatas" required>
            </li>
            <li>
                <button type="submit" name="submit">Create data!</button>
            </li>
        </ul>
    </form>
</body>
</html>