<?php
session_start();
if(!isset($_SESSION["login"])) { // jika tidak ada sesi login maka tendang user ke halaman login
    header("location: login_admin.php");
    exit;
}
require 'functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if (createSupply($_POST) > 0) {
        echo "
            <script>
                alert('rekap berhasil ditambahkan!');
                document.location.href = 'supply.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('rekap gagal ditambahkan!');
                document.location.href = 'supply.php';
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
    <title>Tambah Obat</title>

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
                    <h2>Tambah Rekap supply Baru</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="tgl_pengiriman" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tgl_pengiriman" id="tgl_pengiriman" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_obat" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" name="nama_obat" id="nama_obat" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_obat" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah_obat" id="jumlah_obat" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_supplier" class="form-label">Nama Supplier</label>
                            <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">Tambah data</button>
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