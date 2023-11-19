<?php
    session_start();
    if (!isset($_SESSION["login"])) { // jika tidak ada sesi login maka tendang user ke halaman login
        header("location: login_admin.php");
        exit;
    }
    require 'functions.php';
    // ambil data di URL
    $id = $_GET["id_obat"];

    if(delete($id) > 0) {
        echo "
            <script>
                alert('data berhasil dihapus!');
                document.location.href = 'obat.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus!');
                document.location.href = 'obat.php';
            </script>
            ";
    }

?>