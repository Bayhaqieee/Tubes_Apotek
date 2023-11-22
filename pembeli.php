<?php
session_start(); 
if(isset($_SESSION["login"])) {
    header("Location: pembeli.php");
    exit;
} 

require 'functions.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User page</title>
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
                        <a class="nav-link active" aria-current="page" href="pembeli.php">Home</a>
                    </li>
                    <li class="nav-item ps-3 pe-3">
                        <a class="nav-link " href="pembeli_toko.php">Toko Obat</a>
                    </li>
                    <li class="nav-item ps-3 pe-3">
                        <a class="nav-link " href="pembeli_riwayat.php">Riwayat</a>
                    </li>
                    <li class="nav-item ps-3 pe-3">
                        <a class="nav-link " href="pembeli_kontak.php">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar end  -->

    <!-- content  -->
    <section class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-5">
                <h1>
                    Selamat Datang <span class="text-success"><?= getUserName() ?></span>!
                </h1>
                <p class="fw-medium">Apapun keluhannya, beli obat di <span class="text-success fw-bold">YPTA</span><span class="fw-bold">potek</span>!</p>
                <div class="card" style="width: 14rem;">
                    <img src="img/toko obat.jpg" class="card-img-top" alt="toko obat">
                    <div class="card-body text-center">
                        <a href="toko.php" class="btn btn-outline-success">Beli Obat Sekarang!</a>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <img src="img/home.jpg" alt="" width="500" height="500">
            </div>
        </div>
    </section>
    <!-- content end  -->

    <!-- script  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>