<?php
    session_start();
    if (!isset($_SESSION["login"])) { // jika tidak ada sesi login maka tendang user ke halaman login
        header("location: login_admin.php");
        exit;
    }
    require 'functions.php';

    $id = $_GET["id_beli"];

        if (rekap($id)>0) {
            echo "
                <script>
                    alert('Rekap berhasil ditambahkan!');
                    document.location.href = 'rekap.php';
                </script>
                ";
        } else {
            echo "
                <script>
                    alert('Rekap gagal ditambahkan!');
                    document.location.href = 'rekap.php';
                </script>
                ";
        }
?>
