<?php
session_start();
if (!isset($_SESSION["login_pembeli"])) { // jika tidak ada sesi login maka tendang user ke halaman login
    header("location: login_user.php");
    exit;
}

require 'functions.php';
$beli = query("SELECT * FROM beli ORDER BY tgl_beli DESC "); // ORDER BY ASC(mengurutkan dari paling kecil ke besar) | DESC(mengurutkan dari id paling besar ke kecil)

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat</title>

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
                        <a class="nav-link " aria-current="page" href="pembeli.php">Home</a>
                    </li>
                    <li class="nav-item ps-3 pe-3">
                        <a class="nav-link " href="pembeli_toko.php">Toko Obat</a>
                    </li>
                    <li class="nav-item ps-3 pe-3">
                        <a class="nav-link active" href="pembeli_riwayat.php">Riwayat</a>
                    </li>
                    <li class="nav-item ps-3 pe-3">
                        <a class="nav-link " href="pembeli_kontak.php">Kontak</a>
                    </li>
                    <li class="nav-item ps-3 pe-3">
                        <form action="logout_user.php" method="post">
                            <button class="btn btn-success" type="submit" name="logout" onclick="return confirm('Keluar?');">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar end  -->

    <!-- content  -->

    <!-- table beli  -->
    <section class="container">
        <h1 class="mt-3 mb-3">Riwayat pembelian Obat</h1>

        <table class="table table-striped table-hover table-bordered text-center mb-5">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Jumlah Pembelian</th>
                    <th scope="col">Harga Total</th>
                    <!-- <th scope="col">Total harga</th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($beli as $b) : ?>
                    <?php
                    if ($b["id_pembeli"] === getIdPembeliFromSession()) {
                    ?>
                        <tr>
                            <td><?= $b["tgl_beli"] ?></td>
                            <td><?= namaObat($b["id_obat"]); ?></td>
                            <td><?= $b["jml_beli"]; ?></td>
                            <td><?= totalHarga($b["jml_beli"]); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </section>
    <!-- table beli end  -->
    <!-- content end  -->

    <!-- script  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>