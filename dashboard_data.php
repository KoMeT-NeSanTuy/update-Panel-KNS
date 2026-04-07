<?php
require "koneksi.php";

$total = $conn->query("SELECT COUNT(*) as t FROM pelanggan")->fetch_assoc()['t'];
$online = $conn->query("SELECT COUNT(*) as t FROM pelanggan WHERE status='online'")->fetch_assoc()['t'];
$offline = $conn->query("SELECT COUNT(*) as t FROM pelanggan WHERE status='offline'")->fetch_assoc()['t'];

echo json_encode([
    "total" => $total,
    "online" => $online,
    "offline" => $offline
]);
