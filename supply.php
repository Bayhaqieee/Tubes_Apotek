<?php
session_start();
if(!isset($_SESSION["login_admin"])) { // jika tidak ada sesi login maka tendang user ke halaman login
    header("location: login_admin.php");
    exit;
}
require 'functions.php';
$supply = query("SELECT * FROM supply ORDER BY id_pengiriman DESC"); 

// jika tombol cari di klik
if (isset($_POST["cari"])) {
    $supply = searchSupply($_POST["keyword"]);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Supply Obat</title>

    <!-- bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- bootstrap-icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body>
    <!-- navbar  -->
    <nav class="navbar navbar-expand-lg navbar-light bg-success-subtle sticky-top">
        <div class="container">
            <a class="navbar-brand p-0 m-0 fs-2 fw-bold" href="#"><span class="text-success ">YPTA</span>potek.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item ps-3 pe-3">
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item ps-3 pe-3">
                        <a class="nav-link " href="obat.php">Kelola Obat</a>
                    </li>
                    <li class="nav-item ps-3 pe-3">
                        <a class="nav-link " href="rekap.php">Buat Rekap</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Laporan Transaksi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="beli.php">Pembelian Obat</a></li>
                            <li><a class="dropdown-item active bg-success" href="supply.php">Supply Obat</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ps-3 pe-3">
                        <form action="logout_admin.php" method="post">
                            <button class="btn btn-success" type="submit" name="logout" onclick="return confirm('Keluar?');">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar end  -->

    <!-- content  -->
    <div class="container">
        <h1 class="mt-3 mb-3">Daftar Supply Obat</h1>

        <!-- search -->
        <div class="row mb-3">
            <div class="col-md-5">
                <form action="" method="post">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Masukkan tahun-bulan-tanggal dalam angka" autocomplete="off">
                        <button class="btn btn-warning" type="submit" name="cari">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- search end  -->

        <!-- add recap  -->
        <a class="btn btn-outline-success mb-3" href="supply_create.php"><i class="bi bi-plus-square-fill"></i> Tambah rekap supply</a>
        <!-- add recap end  -->

        <!-- supplier view  -->
        <a class="btn btn-info btn-sm mb-3 float-end" href="supplier.php"><i class="bi bi-eye-fill"></i> Lihat Daftar Supplier</a>
        <!-- supplier view end  -->

        <!-- table obat  -->
        <table class="table table-striped table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Nama Supplier</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($supply as $s) : ?>
                    <tr>
                        <td><?= $s["tgl_pengiriman"] ?></td>
                        <td><?= namaObatForSupply($s["id_obat"]); ?></td>
                        <td><?= $s["jumlah_obat"]; ?></td>
                        <td><?= namaSupplierForSupply($s["id_supplier"]); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- table obat end  -->
    <!-- content end  -->

    <!-- script js  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>