<?php
session_start();
if (!isset($_SESSION["login_pembeli"])) { // jika tidak ada sesi login maka tendang user ke halaman login
    header("location: login_user.php");
    exit;
}
require 'functions.php';

$id = $_GET["id_obat"];

$obat = query("SELECT * FROM obat WHERE id_obat = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil ditambahkan atau tidak
    if (createBeli($_POST) > 0) {
        echo "
            <script>
                alert('pembelian berhasil!');
                document.location.href = 'pembeli_toko.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('pembelian gagal!');
                document.location.href = 'pembeli_toko.php';
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
    <title>Beli Obat</title>

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
                    <h2>Beli Obat</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nama_obat" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" name="nama_obat" id="nama_obat" required value="<?= $obat["nama_obat"]; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="stok_obat" class="form-label">Stok Obat</label>
                            <input type="number" class="form-control" name="stok_obat" id="stok_obat" required value="<?= $obat["stok_obat"]; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jml_beli" class="form-label">Jumlah Beli</label>
                            <input type="number" class="form-control" name="jml_beli" id="jml_beli" min="1" required>
                        </div>
                        <div class="mb-3">
                            <p id="total_harga_display" class="form-control-static"></p>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success" onclick="return confirm('Yakin untuk melakukan pembelian ini?');">Beli</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- content end  -->

    <!-- script js  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- local script  -->
    <script>
        document.getElementById('jml_beli').addEventListener('input', function() {
            var jml_beli = parseInt(this.value); // Mendapatkan nilai dari input jml_beli

            // Mengatur nilai maksimum pada input jml_beli sesuai dengan stok obat
            var stok_obat = <?php echo getStokObat($obat["id_obat"]); ?>;
            this.setAttribute('max', stok_obat);

            // Jika jumlah beli melebihi stok obat, atur nilai input menjadi maksimum
            if (jml_beli > stok_obat) {
                this.value = stok_obat;
            } else {
                this.value = jml_beli;
            }

            // Kalkulasi total harga
            var harga_obat = <?php echo $obat["harga_obat"]; ?>;
            var total_harga = harga_obat * jml_beli;
            document.getElementById('total_harga_display').innerText = "Total Harga: Rp" + total_harga;
        });
    </script>

</body>

</html>