<?php
session_start();
if (!isset($_SESSION["login"])) { // jika tidak ada sesi login maka tendang user ke halaman login
    header("location: login_admin.php");
    exit;
}
require 'functions.php';

$rekap = query("SELECT * FROM beli ORDER BY tgl_beli DESC "); // ORDER BY ASC(mengurutkan dari paling kecil ke besar) | DESC(mengurutkan dari id paling besar ke kecil)

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Rekap Pembelian</title>

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
                        <a class="nav-link active" href="rekap.php">Buat Rekap</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Laporan Transaksi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="beli.php">Pembelian Obat</a></li>
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
        <h1 class="mt-3 mb-3">Buat Rekap Pembelian Obat</h1>

        <!-- table beli  -->
        <table class="table table-striped table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Pembeli</th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Jumlah Pembelian</th>
                    <th scope="col">Total harga</th>
                    <th scope="col">Buat Rekap</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rekap as $r) : ?>
                    <?php
                    // Menampilkan baris dengan id_pegawai NULL
                    if ($r["id_pegawai"] === null) {
                    ?>
                        <tr>
                            <td><?= $r["tgl_beli"]; ?></td>
                            <td><?= namaPembeli($r["id_pembeli"]); ?></td>
                            <td><?= namaObat($r["id_obat"]); ?></td>
                            <td><?= $r["jml_beli"]; ?></td>
                            <td><?= totalHarga($r["jml_beli"]); ?></td>
                            <td>
                                <a class="btn btn-success mb-1" href="rekap_create.php?id_beli=<?= $r["id_beli"]; ?>" onclick="return confirm('Buat Rekap?');">Buat</a>
                            </td>
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