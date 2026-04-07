<?php
require __DIR__ . "/config.php";
include "layout/header.php";

// data
$total = $conn->query("SELECT COUNT(*) as t FROM pelanggan")->fetch_assoc()['t'];
$online = $conn->query("SELECT COUNT(*) as t FROM pelanggan WHERE status='online'")->fetch_assoc()['t'];
$offline = $conn->query("SELECT COUNT(*) as t FROM pelanggan WHERE status='offline'")->fetch_assoc()['t'];
?>

<div class="d-flex justify-content-between mb-3">
    <h4><b>Dashboard</b></h4>
</div>

<div class="row">

    <div class="col-md-4">
        <div class="card bg-primary text-white p-3">
            <h6>Total Client</h6>
            <h2 id="total"><?= $total ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white p-3">
            <h6>Online</h6>
            <h2 id="online"><?= $online ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-danger text-white p-3">
            <h6>Offline</h6>
            <h2 id="offline"><?= $offline ?></h2>
        </div>
    </div>

</div>

<script>
// 🔥 AUTO REFRESH 5 DETIK
setInterval(() => {
    fetch('dashboard_data.php')
    .then(res => res.json())
    .then(data => {
        document.getElementById('total').innerText = data.total;
        document.getElementById('online').innerText = data.online;
        document.getElementById('offline').innerText = data.offline;
    });
}, 5000);
</script>

<?php include "layout/footer.php"; ?>
