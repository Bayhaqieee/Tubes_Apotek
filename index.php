<?php
require 'functions.php';
$obat = query("SELECT * FROM obat ORDER BY nama_obat ASC "); // ORDER BY ASC(mengurutkan dari paling kecil ke besar) | DESC(mengurutkan dari id paling besar ke kecil)

// jika tombol cari di klik
if(isset($_POST["cari"])) {
    $obat = search($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    <h1>Daftar obat-obat yang di jual di apotek</h1>
    <a href="create.php">Tambah obat baru</a>
    <br><br>
    <form action="" method="post" >
        <input type="text" name="keyword" size="35" autofocus 
        placeholder="Masukkan keyword pencarian" autocomplete="off">
        <button type="submit" name="cari" >Cari!</button>
    </form>
    <br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Nama Obat</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Jenis</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($obat as $o) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="update.php?id_obat=<?= $o["id_obat"]; ?>" >ubah</a> |
                <a href="delete.php?id_obat=<?= $o["id_obat"]; ?>" onclick="return confirm('yakin?');">hapus</a>
            </td>
            <td><?= $o["nama_obat"]; ?></td>
            <td><?= $o["harga_obat"]; ?></td>
            <td><?= $o["stok_obat"]; ?></td>
            <td><?= $o["jenis_obat"]; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>