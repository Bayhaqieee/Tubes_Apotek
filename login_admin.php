<?php
session_start();
if (isset($_SESSION["login_admin"])) {
    header("Location: index.php");
    exit;
}
require 'functions.php';
// cek apakah tombol sign in sudah ditekan atau belum
if (isset($_POST["login"])) {
    $username = $_POST["nama_pegawai"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM pegawai WHERE nama_pegawai = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if ($password === $row["no_telp"]) {
            //set session admin
            $_SESSION["login_admin"] = true;
            $_SESSION["username_admin"] = $username;
            header("location: index.php");
            exit;
        }
    }

    $error = true;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login Admin</title>

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
                    <h2>Login</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nama_pegawai" class="form-label">Username</label>
                            <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-success">Login</button>
                    </form>
                    <?php if (isset($error)) : ?>
                        <p style="color: red; ">Username/Password salah!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- content end  -->

    <!-- script js  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>