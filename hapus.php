<?php
include __DIR__ . "/koneksi.php";

$id = $_GET['id'];

$conn->query("DELETE FROM pelanggan WHERE id=$id");

header("Location: pelanggan.php");
?>
