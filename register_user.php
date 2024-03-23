<?php
require 'functions.php';
//cek apakah tombol sign up sudah ditekan atau belum
if(isset($_POST["register"])) {
    // jalankan fungsi register
    // jika fungsi register berhasil dijalankan
    if(register ($_POST) > 0) {
        echo "<script>
                alert('User baru berhasil ditambahkan!');
                document.location.href = 'login_user.php';
            </script>";
    }else {
        echo mysqli_error($conn);
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Register User</title>

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
                    <h2>Register</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nama_pembeli" class="form-label">Username</label>
                            <input type="text" class="form-control" name="nama_pembeli" id="nama_pembeli" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password2" id="password2" required>
                        </div>
                        <button type="submit" name="register" class="btn btn-success mb-5">Sign up now!</button>
                        <p>Sudah punya akun? Login <a href="login_user.php">DISINI!</a></p>
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