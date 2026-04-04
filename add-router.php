<?php include "layout/header.php"; include "config.php"; ?>

<h2>Tambah Router</h2>

<form method="POST" class="col-md-4">

<input class="form-control mb-2" name="name" placeholder="Nama Router">
<input class="form-control mb-2" name="ip" placeholder="IP VPN">
<input class="form-control mb-2" name="port" placeholder="Port Winbox">

<button class="btn btn-primary">Simpan</button>

</form>

<?php
$uid = $_SESSION['user_id'];
if ($_POST) {
    $name = $_POST['name'];
    $ip = $_POST['ip'];
    $port = $_POST['port'];
     $conn->query("INSERT INTO routers (user_id, name, ip_vpn, port)
VALUES ('$uid','$name','$ip','$port')");
    echo "<script>window.location='routers.php';</script>";
}
?>

<?php include "layout/footer.php"; ?>
