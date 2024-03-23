<!-- logout.php -->
<?php
session_start();
if (!isset($_SESSION["login_pembeli"])) { // jika tidak ada sesi login maka tendang user ke halaman login
    header("location: login_user.php");
    exit;
}

// Hapus semua variabel sesi
$_SESSION = array();

// Hapus sesi
session_destroy();

// Redirect ke halaman login
header("location: login_user.php");
exit;
?>
