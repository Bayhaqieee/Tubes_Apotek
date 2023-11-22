<?php
session_start();
if(!isset($_SESSION["login_admin"])) { // jika tidak ada sesi login maka tendang user ke halaman login
    header("location: login_admin.php");
    exit;
}
require 'functions.php';

// ambil data di URL
$id = $_GET["id_obat"];

$obat = query("SELECT * FROM obat WHERE id_obat = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil diubah atau tidak
    if (update($_POST) > 0) {
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

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah Data Obat</title>

    <!-- bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- bootstrap-icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body>
    <!-- content  -->
    <section class="">
        <div class="container-fluid pb-5 mb-5">
            <div class="row text-center pt-5 pb-3">
                <div class="col text-success">
                    <h2>Ubah Data Obat</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <form action="" method="post">
                        <input type="hidden" name="id_obat" value="<?= $obat["id_obat"]; ?>">
                        <div class="mb-3">
                            <label for="nama_obat" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" name="nama_obat" id="nama_obat" required value="<?= $obat["nama_obat"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="harga_obat" class="form-label">Harga Obat</label>
                            <input type="number" class="form-control" name="harga_obat" id="harga_obat" required value="<?= $obat["harga_obat"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="stok_obat" class="form-label">Stok Obat</label>
                            <input type="number" class="form-control" name="stok_obat" id="stok_obat" required value="<?= $obat["stok_obat"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="jenis_obat" class="form-label">Jenis Obat</label>
                            <input type="text" class="form-control" name="jenis_obat" id="jenis_obat" placeholder="obat keras/bebas/bebas terbatas" required value="<?= $obat["jenis_obat"]; ?>">
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">Ubah data</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- content end  -->

    <!-- script js  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>