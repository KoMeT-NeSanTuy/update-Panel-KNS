<?php
$conn = new mysqli("localhost", "panel", "panel123", "isp_panel");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
