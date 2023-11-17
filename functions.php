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
                harga_obat = '$harga',
                stok_obat = '$stok',
                jenis_obat = '$jenis',
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
