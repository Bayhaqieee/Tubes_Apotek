<?php
require 'functions.php';

// ambil data di URL
$id = $_GET["id_obat"];

// query data kru berdasarkan id
$obat = query("SELECT * FROM obat WHERE id_obat = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"])) {

    // cek apakah data berhasil diubah atau tidak
    if( update($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'obat.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
                document.location.href = 'obat.php';
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
    <title>Update data obat</title>
</head>
<body>
    <h1>Update data obat</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_obat" value="<?= $obat["id_obat"]; ?>">
        <ul>
            <li>
                <label for="nama_obat">Nama Obat: </label>
                <input type="text" name="nama_obat" id="nama_obat" required value="<?= $obat["nama_obat"]; ?>">
            </li>
            <li>
                <label for="harga_obat">Harga Obat: </label>
                <input type="number" name="harga_obat" id="harga_obat" required value="<?= $obat["harga_obat"]; ?>">
            </li>
            <li>
                <label for="stok_obat">Stok Obat: </label>
                <input type="number" name="stok_obat" id="stok_obat" required value="<?= $obat["stok_obat"]; ?>" >
            </li>
            <li>
                <label for="jenis_obat">Jenis Obat: </label>
                <input type="text" name="jenis_obat" id="jenis_obat" placeholder="Obat Keras/Bebas/Bebas terbatas" required value="<?= $obat["jenis_obat"]; ?>" >
            </li>
            <li>
                <button type="submit" name="submit">Update data!</button>
            </li>
        </ul>
    </form>
</body>
</html>