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
    $result = mysqli_query($conn,$query);
    $nama_obat = "";
    if($result) {
        while($row = mysqli_fetch_assoc($result)) {
            if($row) {
                $nama_obat = $row['nama_obat'];
            }
        }
    }else {
        echo "Query error" .mysqli_error($conn);
    }

    return $nama_obat;
}

function namaPembeli($id_pembeli)
{
    global $conn;
    $query = "SELECT pembeli.nama_pembeli 
                FROM beli
                JOIN pembeli ON beli.id_pembeli = pembeli.id_pembeli
                WHERE beli.id_pembeli = $id_pembeli;
            ";
    $result = mysqli_query($conn,$query);
    $nama_pembeli = "";
    if($result) {
        while($row = mysqli_fetch_assoc($result)) {
            if($row) {
                $nama_pembeli = $row['nama_pembeli'];
            }
        }
    }else {
        echo "Query error" .mysqli_error($conn);
    }

    return $nama_pembeli;
}

function totalHarga($id_obat)
{
    global $conn;
    $query = "SELECT SUM(beli.jml_beli * obat.harga_obat) AS total_harga
                FROM beli
                JOIN obat ON beli.id_obat = obat.id_obat
                WHERE beli.id_obat = $id_obat;
            ";

    $result = mysqli_query($conn, $query);
    $total_harga = 0;

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
