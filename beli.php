<?php
session_start();
if (!isset($_SESSION["login"])) { // jika tidak ada sesi login maka tendang user ke halaman login
    header("location: login_admin.php");
    exit;
}
require 'functions.php';
$beli = query("SELECT * FROM beli ORDER BY tgl_beli DESC "); // ORDER BY ASC(mengurutkan dari paling kecil ke besar) | DESC(mengurutkan dari id paling besar ke kecil)

// jika tombol cari di klik
if (isset($_POST["cari"])) {
    $beli = searchBeli($_POST["keyword"]);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Transaksi</title>

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
                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Laporan Transaksi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item active bg-success" href="beli.php">Pembelian Obat</a></li>
                            <li><a class="dropdown-item" href="supply.php">Supply Obat</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar end  -->

    <!-- content  -->
    <div class="container">
        <h1 class="mt-3 mb-3">Daftar Transaksi Pembelian Obat</h1>

        <!-- search -->
        <div class="row">
            <div class="col-md-5">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="keyword" class="form-control" placeholder="Masukkan tahun-bulan-tanggal dalam angka" autocomplete="off">
                        <button class="btn btn-warning" type="submit" name="cari">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- search end  -->

        <!-- table beli  -->
        <table class="table table-striped table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Pembeli</th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Jumlah Pembelian</th>
                    <th scope="col">Total harga</th>
                    <th scope="col">Pegawai yang merekap</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($beli as $b) : ?>
                    <?php
                    // Menampilkan baris dengan id_pegawai NULL
                    if ($b["id_pegawai"] !== null) {
                    ?>
                        <tr>
                            <td><?= $b["tgl_beli"]; ?></td>
                            <td><?= namaPembeli($b["id_pembeli"]); ?></td>
                            <td><?= namaObat($b["id_obat"]); ?></td>
                            <td><?= $b["jml_beli"]; ?></td>
                            <td><?= totalHarga($b["jml_beli"]); ?></td>
                            <td><?= namaPegawai($b["id_pegawai"]); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- table beli end  -->
    <!-- content end  -->

    <!-- script js  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>