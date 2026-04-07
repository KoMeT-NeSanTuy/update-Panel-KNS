<?php
include "koneksi.php";

$aksi = $_POST['aksi'] ?? '';

if($aksi == "delete"){
    $id = $_POST['id'];
    $conn->query("DELETE FROM pelanggan WHERE id='$id'");
    echo "ok";
}

if($aksi == "edit"){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $paket = $_POST['paket'];
    $wa = $_POST['wa'];

    $conn->query("UPDATE pelanggan SET 
        nama='$nama',
        paket='$paket',
        wa='$wa'
    WHERE id='$id'");

    echo "ok";
}

if($aksi == "update_posisi"){
    $id = $_POST['id'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];

    $conn->query("UPDATE pelanggan SET 
        latitude='$lat',
        longitude='$lng'
    WHERE id='$id'");

    echo "ok";
}

