<?php
require 'obat_functions.php';
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
    <title>Daftar Obat</title>

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
                        <a class="nav-link active" href="obat.php">Kelola Obat</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar end  -->

    <!-- content  -->
    <div class="container">
        <h1 class="mt-3 mb-3">Daftar obat</h1>
        <a class="btn btn-outline-success mb-3" href="obat_create.php"><i class="bi bi-plus-square-fill"></i> Tambah obat baru</a>

        <!-- search -->
        <div class="row">
            <div class="col-md-3">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="keyword" class="form-control" placeholder="Masukkan keyword pencarian" autocomplete="off">
                        <button class="btn btn-warning" type="submit" name="cari">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- search end  -->

        <!-- table obat  -->
        <table class="table table-striped table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Jenis</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($obat as $o) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <a class="btn btn-info mb-1" href="obat_update.php?id_obat=<?= $o["id_obat"]; ?>"><i class="bi bi-pencil"></i></a>
                            <a class="btn btn-danger mb-1" href="obat_delete.php?id_obat=<?= $o["id_obat"]; ?>" onclick="return confirm('yakin?');"><i class="bi bi-trash"></i></a>
                        </td>
                        <td><?= $o["nama_obat"]; ?></td>
                        <td><?= $o["harga_obat"]; ?></td>
                        <td><?= $o["stok_obat"]; ?></td>
                        <td><?= $o["jenis_obat"]; ?></td>
                    </tr>
                    <?php $i++; ?>
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