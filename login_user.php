<?php
session_start(); 
if(isset($_SESSION["login"])) {
    header("Location: pembeli.php");
    exit;
} 
require 'functions.php';
    // cek apakah tombol sign in sudah ditekan atau belum
    if(isset($_POST["login"])) {
        $username = $_POST["nama_pembeli"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM pembeli WHERE nama_pembeli = '$username'");
        
        // cek username
        if(mysqli_num_rows($result) === 1) { // fungsi mysqli_num_rows() untuk menghitung ada berapa baris yang dhiasilkan dari $result

            // cek password
            $row = mysqli_fetch_assoc($result);
            if($password === $row["no_telp"]) {
                //set session
                $_SESSION["login"] = true;
                $_SESSION["username"] = $username;
                header("location: pembeli.php");
                exit;
            }
        }
        
        $error = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        input {
            display: block;
        }
    </style>
</head>
<body>
    <h1>Halaman Login</h1>

    <?php if(isset($error)) : ?>
        <p style="color: red; font-style: oblique; ">Username/Password salah!</p>
    <?php endif; ?>
    <!-- action kosong karena kita akan kelola datanya di halaman ini -->
    <form action="" method="post" > 
        <ul>
            <li>
                <label for="nama_pembeli">Username :</label>
                <input type="text" name="nama_pembeli" id="nama_pembeli" autofocus >
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <button type="submit" name="login" >Masuk</button>
            </li>
        </ul>
    </form>

</body>
</html>