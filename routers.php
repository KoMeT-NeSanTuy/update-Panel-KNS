<?php include "layout/header.php"; include "config.php"; ?>

<h2>List Router</h2>

<a href="add-router.php" class="btn btn-primary mb-3">+ Tambah Router</a>

<table class="table table-bordered">
<tr>
<th>Nama</th>
<th>IP VPN</th>
<th>Port</th>
<th>Aksi</th>
</tr>

<?php
$uid = $_SESSION['user_id'];
$data = $conn->query("SELECT * FROM routers WHERE user_id='$uid'");
while($r = $data->fetch_assoc()) {
?>
<tr>
<td><?= $r['name'] ?></td>
<td><?= $r['ip_vpn'] ?></td>
<td><?= $r['port'] ?></td>
<td>
<a class="btn btn-success btn-sm" href="winbox://192.163.88.2:<?= $r['port'] ?>">Connect</a>
</td>
</tr>
<?php } ?>

</table>

<?php include "layout/footer.php"; ?>
