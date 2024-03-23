<?php
session_start();
if(!isset($_SESSION["login_admin"])) { // jika tidak ada sesi login maka tendang user ke halaman login
    header("location: login_admin.php");
    exit;
}
require 'functions.php';
$supplier = query("SELECT * FROM supplier ORDER BY nama_supplier ASC "); // ORDER BY ASC(mengurutkan dari paling kecil ke besar) | DESC(mengurutkan dari id paling besar ke kecil)

// jika tombol cari di klik
if (isset($_POST["cari"])) {
    $supplier = searchSupplier($_POST["keyword"]);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Supplier</title>

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
        <h1 class="mt-3 mb-3">Daftar Supplier</h1>
        <!-- search -->
        <div class="row mb-3">
            <div class="col-md-3">
                <form action="" method="post">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Masukkan keyword pencarian" autocomplete="off">
                        <button class="btn btn-warning" type="submit" name="cari">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- search end  -->

        <!-- add new supplier  -->
        <a class="btn btn-outline-success mb-3" href="supplier_create.php"><i class="bi bi-plus-square-fill"></i> Tambah Supplier baru</a>
        <!-- add new supplier end  -->

        <!-- supply view  -->
        <a class="btn btn-info btn-sm mb-3 float-end" href="supply.php"><i class="bi bi-eye-fill"></i> Lihat Rekap Supply</a>
        <!-- supply view end  -->

        <!-- table  -->
        <table class="table table-striped table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Nama Supplier</th>
                    <th scope="col">No Telepon</th>
                    <th scope="col">Alamat Supplier</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($supplier as $s) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <a class="btn btn-info mb-1" href="supplier_update.php?id_supplier=<?= $s["id_supplier"]; ?>"><i class="bi bi-pencil"></i></a>
                            <a class="btn btn-danger mb-1" href="supplier_delete.php?id_supplier=<?= $s["id_supplier"]; ?>" onclick="return confirm('yakin?');"><i class="bi bi-trash"></i></a>
                        </td>
                        <td><?= $s["nama_supplier"]; ?></td>
                        <td><?= $s["no_telp"]; ?></td>
                        <td><?= $s["alamat_supplier"]; ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- table end  -->
    <!-- content end  -->

    <!-- script js  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>