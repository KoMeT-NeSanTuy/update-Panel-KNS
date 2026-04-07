<?php
require __DIR__ . "/config.php";
include "layout/header.php";

// ambil dari map
$lat = $_GET['lat'] ?? '';
$lng = $_GET['lng'] ?? '';
?>

<h4><b>Tambah Client</b></h4>

<form method="POST">

<div class="row">

<div class="col-md-6">

    <div class="mb-2">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Paket</label>
        <select name="paket" class="form-control">
            <option>10 Mbps</option>
            <option>20 Mbps</option>
            <option>50 Mbps</option>
        </select>
    </div>

    <div class="mb-2">
        <label>No WA</label>
        <input type="text" name="wa" class="form-control">
    </div>

</div>

<div class="col-md-6">

    <div class="mb-2">
        <label>Latitude</label>
        <input type="text" name="latitude" class="form-control" value="<?= $lat ?>">
    </div>

    <div class="mb-2">
        <label>Longitude</label>
        <input type="text" name="longitude" class="form-control" value="<?= $lng ?>">
    </div>

    <div class="mb-2">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="online">Online</option>
            <option value="offline">Offline</option>
        </select>
    </div>

</div>

</div>

<button name="simpan" class="btn btn-success mt-3">Simpan</button>

</form>

<?php
if (isset($_POST['simpan'])) {

    $conn->query("INSERT INTO pelanggan 
    (nama, paket, wa, latitude, longitude, status)
    VALUES
    ('$_POST[nama]',
     '$_POST[paket]',
     '$_POST[wa]',
     '$_POST[latitude]',
     '$_POST[longitude]',
     '$_POST[status]'
    )");

    echo "<script>alert('Berhasil'); window.location='pelanggan.php';</script>";
}
?>

<?php include "layout/footer.php"; ?>
