<?php
require __DIR__ . "/koneksi.php";
include "layout/header.php";

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM pelanggan WHERE id='$id'")->fetch_assoc();
?>

<h4><b>Edit Client</b></h4>

<form method="POST">

<div class="row">

<div class="col-md-6">

    <div class="mb-2">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
    </div>

    <!-- 🔥 FIX PAKET (HANYA 1 FIELD) -->
    <div class="mb-2">
        <label>Paket</label>
        <select name="paket" class="form-control">
            <option <?= $data['paket']=='10 Mbps'?'selected':'' ?>>10 Mbps</option>
            <option <?= $data['paket']=='20 Mbps'?'selected':'' ?>>20 Mbps</option>
            <option <?= $data['paket']=='50 Mbps'?'selected':'' ?>>50 Mbps</option>
        </select>
    </div>

    <div class="mb-2">
        <label>No WA</label>
        <input type="text" name="wa" class="form-control" value="<?= $data['wa'] ?>">
    </div>

</div>

<div class="col-md-6">

    <div class="mb-2">
        <label>Latitude</label>
        <input type="text" name="latitude" class="form-control" value="<?= $data['latitude'] ?>">
    </div>

    <div class="mb-2">
        <label>Longitude</label>
        <input type="text" name="longitude" class="form-control" value="<?= $data['longitude'] ?>">
    </div>

    <div class="mb-2">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="online" <?= $data['status']=='online'?'selected':'' ?>>Online</option>
            <option value="offline" <?= $data['status']=='offline'?'selected':'' ?>>Offline</option>
        </select>
    </div>

</div>

</div>

<button name="update" class="btn btn-primary mt-3">Update</button>

</form>

<?php
if (isset($_POST['update'])) {

    $conn->query("UPDATE pelanggan SET
        nama='$_POST[nama]',
        paket='$_POST[paket]',
        wa='$_POST[wa]',
        latitude='$_POST[latitude]',
        longitude='$_POST[longitude]',
        status='$_POST[status]'
        WHERE id='$id'
    ");

    echo "<script>alert('Berhasil diupdate'); window.location='pelanggan.php';</script>";
}
?>

<?php include "layout/footer.php"; ?>
