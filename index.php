<?php
session_start();
if (!isset($_SESSION["login"])) { // jika tidak ada sesi login maka tendang user ke halaman login
    header("location: login_admin.php");
    exit;
}

require 'functions.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item ps-3 pe-3">
                        <a class="nav-link " href="obat.php">Kelola Obat</a>
                    </li>
                    <li class="nav-item ps-3 pe-3">
                        <a class="nav-link " href="rekap.php">Buat Rekap</a>
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
    <div class="row justify-content-center align-items-center text-center mt-5 pt-5">
        <div class="col-md-6">
            <h1>
                HALO <span class="text-success"><?= getUserName() ?></span>,<br>SELAMAT DATANG DI<br>HALAMAN ADMIN!
            </h1>
        </div>
    </div>
    <!-- content end  -->

    <!-- script  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>