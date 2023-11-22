<?php
// session_start();
// if (!isset($_SESSION["login"])) { // jika tidak ada sesi login maka tendang user ke halaman login
//     header("location: login_user.php");
//     exit;
// }

require 'functions.php';
$beli = query("SELECT * FROM beli ORDER BY tgl_beli DESC ");
$obat = query("SELECT * FROM obat ORDER BY nama_obat ASC "); // ORDER BY ASC(mengurutkan dari paling kecil ke besar) | DESC(mengurutkan dari id paling besar ke kecil)

// jika tombol cari di klik
if (isset($_POST["cari"])) {
        $obat = search($_POST["keyword"]);
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin page</title>

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
                        <a class="nav-link active" href="pembeli_toko.php">Toko Obat</a>
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
        <h3 class="mt-3 mb-3"><i class="bi bi-cart4"></i> Keranjang Pembelian </h3>

        <!-- table beli  -->
        <table class="table table-striped table-hover table-bordered text-center mb-5">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Jumlah Pembelian</th>
                    <!-- <th scope="col">Total harga</th> -->
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($beli as $b) : ?>
                    <?php
                    // Menampilkan baris dengan id_pegawai NULL
                    if ($b["id_pembeli"] === null) {
                    ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= namaObat($b["id_obat"]); ?></td>
                            <td><?= $b["jml_beli"]; ?></td>
                            <!-- <td><?= totalHarga($b["jml_beli"]); ?></td> -->
                        </tr>
                        <?php $i++; ?>
                    <?php
                    }
                    ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        <!-- table beli end  -->

        <hr>

        <!-- search -->
        <div class="row">
            <div class="col-md-3">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari obatmu di sini!" autocomplete="off">
                        <button class="btn btn-warning" type="submit" name="cari">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- if not search  -->
        <?php if (isset($error)) : ?>
            <p class="fs-3 fw-medium">Maaf, Obat belum/tidak tersedia.</p>
        <?php endif; ?>
        <!-- if not search end  -->
        <!-- search end  -->

        <div class="row mt-4">
            <?php foreach ($obat as $o) : ?>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $o["nama_obat"]; ?></h5>
                                    <p class="card-text">Harga: Rp<?= $o["harga_obat"]; ?></p>
                                    <p class="card-text">Stok: <?= $o["stok_obat"]; ?></p>
                                    <a href="#" class="btn btn-success">Beli</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>



    </section>
    <!-- content end  -->

    <!-- script  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>