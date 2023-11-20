<?php
session_start();
if(!isset($_SESSION["login"])) { // jika tidak ada sesi login maka tendang user ke halaman login
    header("location: login_admin.php");
    exit;
}
require 'functions.php';

// ambil data di URL
$id = $_GET["id_supplier"];

// query data kru berdasarkan id
$supplier = query("SELECT * FROM supplier WHERE id_supplier = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil diubah atau tidak
    if (updateSupplier($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil diubah!');
                document.location.href = 'supplier.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('data gagal diubah!');
                document.location.href = 'supplier.php';
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
    <title>Ubah Data Supplier</title>

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
                    <h2>Ubah Data Supplier</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <form action="" method="post">
                        <input type="hidden" name="id_supplier" value="<?= $supplier["id_supplier"]; ?>">
                        <div class="mb-3">
                            <label for="nama_supplier" class="form-label">Nama Supplier</label>
                            <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" required value="<?= $supplier["nama_supplier"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" name="no_telp" id="no_telp" required value="<?= $supplier["no_telp"]; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="alamat_supplier" class="form-label">Alamat Supplier</label>
                            <input type="text" class="form-control" name="alamat_supplier" id="alamat_supplier" required value="<?= $supplier["alamat_supplier"]; ?>">
                        </div>
                        <button type="submit" name="submit" class="btn btn-success">Ubah data</button>
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