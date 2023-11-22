<?php
// 1. koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "tubes");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function create($data)
{
    global $conn;
    // ambil data dari tiap elemen dalam form
    $nama = htmlspecialchars($data["nama_obat"]);
    $harga = htmlspecialchars($data["harga_obat"]);
    $stok = htmlspecialchars($data["stok_obat"]);
    $jenis = htmlspecialchars($data["jenis_obat"]);

    // query insert data
    $query = "INSERT INTO obat
    VALUES
    ('','$nama','$harga','$stok','$jenis')
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}



function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM obat WHERE id_obat=$id");
    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    // ambil data dari tiap elemen dalam form
    $id = $data["id_obat"];
    $nama = htmlspecialchars($data["nama_obat"]);
    $harga = htmlspecialchars($data["harga_obat"]);
    $stok = htmlspecialchars($data["stok_obat"]);
    $jenis = htmlspecialchars($data["jenis_obat"]);

    //query update data
    $query = "UPDATE obat SET
                nama_obat = '$nama',
                harga_obat = $harga,
                stok_obat = $stok,
                jenis_obat = '$jenis'
            WHERE id_obat = $id
            ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function search($keyword)
{
    $query = "SELECT * FROM obat 
                WHERE 
                nama_obat LIKE '%$keyword%' OR
                harga_obat LIKE '%$keyword%' OR
                stok_obat LIKE '%$keyword%' OR
                jenis_obat LIKE '%$keyword%' 
            ";
    return query($query);
}

function namaObat($id_obat)
{
    global $conn;
    $query = "SELECT obat.nama_obat 
                FROM beli
                JOIN obat ON beli.id_obat = obat.id_obat
                WHERE beli.id_obat = $id_obat;
            ";
    $result = mysqli_query($conn, $query);
    $nama_obat = "";
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row) {
                $nama_obat = $row['nama_obat'];
            }
        }
    } else {
        echo "Query error" . mysqli_error($conn);
    }

    return $nama_obat;
}

function namaObatForSupply($id_obat)
{
    global $conn;
    $query = "SELECT obat.nama_obat 
                FROM supply
                JOIN obat ON supply.id_obat = obat.id_obat
                WHERE supply.id_obat = $id_obat;
            ";
    $result = mysqli_query($conn, $query);
    $nama_obat = "";
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row) {
                $nama_obat = $row['nama_obat'];
            }
        }
    } else {
        echo "Query error" . mysqli_error($conn);
    }

    return $nama_obat;
}

function namaSupplierForSupply($id_supplier)
{
    global $conn;
    $query = "SELECT supplier.nama_supplier 
                FROM supply
                JOIN supplier ON supply.id_supplier = supplier.id_supplier
                WHERE supplier.id_supplier = $id_supplier;
            ";
    $result = mysqli_query($conn, $query);
    $nama_supplier = "";
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row) {
                $nama_supplier = $row['nama_supplier'];
            }
        }
    } else {
        echo "Query error" . mysqli_error($conn);
    }

    return $nama_supplier;
}

function createSupply($data)
{
    global $conn;
    // ambil data dari tiap elemen dalam form
    $tgl_pengiriman = htmlspecialchars($data["tgl_pengiriman"]);
    $nama_obat = htmlspecialchars($data["nama_obat"]);
    $jumlah_obat = htmlspecialchars($data["jumlah_obat"]);
    $nama_supplier = htmlspecialchars($data["nama_supplier"]);

    // query insert data
    $query = "INSERT INTO supply
    VALUES
    ('','$tgl_pengiriman','$jumlah_obat','$nama_supplier','$nama_obat')
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function namaPembeli($id_pembeli)
{
    global $conn;
    $query = "SELECT pembeli.nama_pembeli 
                FROM beli
                JOIN pembeli ON beli.id_pembeli = pembeli.id_pembeli
                WHERE beli.id_pembeli = $id_pembeli;
            ";
    $result = mysqli_query($conn, $query);
    $nama_pembeli = "";
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row) {
                $nama_pembeli = $row['nama_pembeli'];
            }
        }
    } else {
        echo "Query error" . mysqli_error($conn);
    }

    return $nama_pembeli;
}

function namaPegawai($id_pegawai)
{
    global $conn;
    $query = "SELECT pegawai.nama_pegawai 
                FROM beli
                JOIN pegawai ON beli.id_pegawai = pegawai.id_pegawai
                WHERE beli.id_pegawai = $id_pegawai;
            ";
    $result = mysqli_query($conn, $query);
    $nama_pegawai = "";
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row) {
                $nama_pegawai = $row['nama_pegawai'];
            }
        }
    } else {
        echo "Query error" . mysqli_error($conn);
    }

    return $nama_pegawai;
}

function totalHarga($jml_beli)
{
    global $conn;
    $query = "SELECT beli.jml_beli * obat.harga_obat AS total_harga
                FROM beli
                JOIN obat ON beli.id_obat = obat.id_obat
                WHERE beli.jml_beli = $jml_beli;
            ";

    $result = mysqli_query($conn, $query);
    $total_harga=0;

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $total_harga = $row['total_harga'];
        }
    } else {
        echo "Query error: " . mysqli_error($conn);
    }

    return $total_harga;
}

function searchBeli($keyword)
{
    $query = "SELECT * FROM beli
                WHERE 
                tgl_beli LIKE '%$keyword%'
            ";
    return query($query);
}

// functions.phpsession
function getIdPegawaiFromSession()
{
    if (isset($_SESSION["username_admin"])) {
        global $conn;
        $username = $_SESSION['username_admin'];

        // Ambil id_pegawai dari tabel pegawai berdasarkan username
        $query = "SELECT id_pegawai FROM pegawai WHERE nama_pegawai = '$username'";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row['id_pegawai'];
        }
    }
    return null;
}

function getUserName()
{
    if (isset($_SESSION['username_admin'])) {
        global $conn;
        $username = $_SESSION['username_admin'];
        $query = "SELECT UPPER(nama_pegawai) AS uppercase_username FROM pegawai WHERE nama_pegawai = '$username'";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            $uppercase_username = $row['uppercase_username'];
            return $uppercase_username;
        }
    }
}

function getIdPembeliFromSession()
{
    if (isset($_SESSION["username_pembeli"])) {
        global $conn;
        $username = $_SESSION['username_pembeli'];

        $query = "SELECT id_pembeli FROM pembeli WHERE nama_pembeli = '$username'";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            return $row['id_pembeli'];
        }
    }
    return null;
}

function getUserPembeli()
{
    if (isset($_SESSION['username_pembeli'])) {
        global $conn;
        $username = $_SESSION['username_pembeli'];
        $query = "SELECT UPPER(nama_pembeli) AS uppercase_username FROM pembeli WHERE nama_pembeli = '$username'";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            $uppercase_username = $row['uppercase_username'];
            return $uppercase_username;
        }
    }
}

function rekap($id)
{
    global $conn;

    $id_pegawai = getIdPegawaiFromSession();

    if ($id_pegawai !== null) {
        $query_update = "UPDATE beli SET id_pegawai = $id_pegawai WHERE id_beli = $id";
        mysqli_query($conn, $query_update);

        return mysqli_affected_rows($conn);
    }
    return 0;
}

function currentDate()
{
    $tanggalSekarang = date("Y-m-d");
    return $tanggalSekarang;
}

function getNamaObat()
{
    global $conn;
    // Query untuk mendapatkan nama obat dari tabel obat
    $query = "SELECT id_obat, nama_obat FROM obat ORDER BY nama_obat ASC";
    $result = mysqli_query($conn, $query);

    // Simpan nama-nama obat ke dalam array
    $nama_obat = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $nama_obat[] = $row['nama_obat'];
    }
    return $nama_obat;
}

function getIdObatByNama($nama_obat)
{
    global $conn;

    // Pastikan nama obat yang diberikan bersih dari SQL Injection
    $nama_obat = mysqli_real_escape_string($conn, $nama_obat);

    // Query untuk mendapatkan id_obat berdasarkan nama obat
    $query = "SELECT id_obat FROM obat WHERE nama_obat = '$nama_obat'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row['id_obat'];
    }

    return null;
}


function getNamaSupplier()
{
    global $conn;
    // Query untuk mendapatkan nama obat dari tabel obat
    $query = "SELECT id_supplier, nama_supplier FROM supplier ORDER BY nama_supplier ASC";
    $result = mysqli_query($conn, $query);

    // Simpan nama-nama obat ke dalam array
    $nama_supplier = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $nama_supplier[] = $row['nama_supplier'];
    }
    return $nama_supplier;
}

function getIdSupplierByNama($nama_supplier)
{
    global $conn;

    // Pastikan nama obat yang diberikan bersih dari SQL Injection
    $nama_supplier = mysqli_real_escape_string($conn, $nama_supplier);

    // Query untuk mendapatkan id_obat berdasarkan nama obat
    $query = "SELECT id_supplier FROM supplier WHERE nama_supplier = '$nama_supplier'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row['id_supplier'];
    }

    return null;
}

function createSupplier($data) 
{
    global $conn;
    // ambil data dari tiap elemen dalam form
    $nama_supplier = htmlspecialchars($data["nama_supplier"]);
    $no_telp = htmlspecialchars($data["no_telp"]);
    $alamat_supplier = htmlspecialchars($data["alamat_supplier"]);

    // query insert data
    $query = "INSERT INTO supplier
    VALUES
    ('','$nama_supplier','$no_telp','$alamat_supplier')
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function searchSupplier($keyword)
{
    $query = "SELECT * FROM supplier 
                WHERE 
                nama_supplier LIKE '%$keyword%' OR
                no_telp LIKE '%$keyword%' OR
                alamat_supplier LIKE '%$keyword%'
            ";
    return query($query);
}

function updateSupplier($data)
{
    global $conn;
    // ambil data dari tiap elemen dalam form
    $id = $data["id_supplier"];
    $nama_supplier = htmlspecialchars($data["nama_supplier"]);
    $no_telp = htmlspecialchars($data["no_telp"]);
    $alamat_supplier = htmlspecialchars($data["alamat_supplier"]);

    //query update data
    $query = "UPDATE supplier SET
                nama_supplier = '$nama_supplier',
                no_telp = '$no_telp',
                alamat_supplier = '$alamat_supplier'
            WHERE id_supplier = $id
            ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function deleteSupplier($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM supplier WHERE id_supplier=$id");
    return mysqli_affected_rows($conn);
}

function searchSupply($keyword)
{
    $query = "SELECT * FROM supply
                WHERE 
                tgl_pengiriman LIKE '%$keyword%'
            ";
    return query($query);
}

function createBeli($data)
{
    global $conn;
    // ambil data dari tiap elemen dalam form
    $tgl_beli = htmlspecialchars(date("Y-m-d"));
    $jml_beli = htmlspecialchars($data["jml_beli"]);
    $id_obat = htmlspecialchars(getIdObatByNama($data["nama_obat"]));
    $id_pembeli = htmlspecialchars(getIdPembeliFromSession());

    // query insert data
    $query = "INSERT INTO beli (id_beli,tgl_beli, jml_beli, id_obat, id_pembeli)
    VALUES
    ('','$tgl_beli','$jml_beli','$id_obat', '$id_pembeli')
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Fungsi untuk mendapatkan stok obat dari database
function getStokObat($id_obat) {
    global $conn;

    $query = "SELECT stok_obat FROM obat WHERE id_obat = $id_obat";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['stok_obat'];
    } else {
        return 0; // Jika stok tidak ditemukan, kembalikan nilai 0
    }
}

// Memeriksa jumlah beli yang diinputkan
function checkJumlahBeli($id_obat, $jumlah_beli) {
    $stok_obat = getStokObat($id_obat); // Mendapatkan stok obat dari fungsi sebelumnya

    if ($jumlah_beli > $stok_obat) {
        // Jika jumlah beli melebihi stok obat, kembalikan stok obat sebagai batas maksimal
        return $stok_obat;
    } else {
        return $jumlah_beli; // Jika tidak, kembalikan jumlah beli yang dimasukkan
    }
}

function register($data) {
    global $conn;

    $username = stripslashes($data["nama_pembeli"]); // fungsi stripslashes untuk menghilangkan slash
    $alamat = stripslashes($data["alamat"]);
    $password = mysqli_real_escape_string($conn, $data["password"]); // fungsi mysqli_real_escape_string() memungkinkan user menambahkan tanda kutip dan masuk ke database
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT nama_pembeli FROM pembeli WHERE nama_pembeli = '$username'");
    
    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('Username sudah ada! Silahkan pilih nama lain');
            </script>";
        return false;
    }

    // cek konfrimasi password
    if($password != $password2) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
            </script>";
        return false;
    }
    
    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO pembeli VALUES('','$username','$alamat','$password')");

    return mysqli_affected_rows($conn); // untuk menghasilkan 1 jika berhasil dan -1 jika tidak berhasil

}

