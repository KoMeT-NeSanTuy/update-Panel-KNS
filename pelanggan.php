<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . "/config.php";
include "layout/header.php";

// 🔥 PAGINATION
$limit = 15;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$start = ($page - 1) * $limit;

// ambil data
$where = "WHERE 1=1";

if (!empty($_GET['group'])) {
    $group = $_GET['group'];
    $where .= " AND group_pelanggan='$group'";
}

if (!empty($_GET['status'])) {
    $status = $_GET['status'];
    $where .= " AND status='$status'";
}

// query data
$data = $conn->query("SELECT * FROM pelanggan $where LIMIT $start, $limit");

// total data
$totalData = $conn->query("SELECT COUNT(*) as total FROM pelanggan $where");
$total = $totalData->fetch_assoc()['total'];
$pages = ceil($total / $limit);
?>

<div class="container mt-3">

    <!-- 🔥 HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><b>Data Pelanggan</b></h4>

        <div>
            <a href="pelanggan_tambah.php" class="btn btn-success">
                <i class="bi bi-plus"></i> Input
            </a>

            <button class="btn btn-primary">
                <i class="bi bi-upload"></i> Import
            </button>

            <button class="btn btn-info text-white">
                <i class="bi bi-download"></i> Export
            </button>
        </div>
    </div>

    <!-- 🔍 SEARCH -->
<div class="d-flex justify-content-between mb-2">

    <div>
        <form method="GET" class="d-flex">

            <select name="group" class="form-select me-2">
                <option value="">Semua Group</option>
                <option value="RW 01">RW 01</option>
                <option value="RW 02">RW 02</option>
            </select>

            <select name="status" class="form-select me-2">
                <option value="">Semua Status</option>
                <option value="online">Online</option>
                <option value="offline">Offline</option>
            </select>

            <button class="btn btn-dark">Filter</button>

        </form>
    </div>

    <input type="text" id="search" class="form-control w-25" placeholder="🔍 Search">
</div>
    <!-- 📊 TABLE -->
    <table class="table table-bordered table-striped table-hover" id="tabel">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Paket</th>
                <th>Alamat</th>
                <th>Group</th>
                <th>WA</th>
                <th>Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = $start + 1; while($row = $data->fetch_assoc()) { ?>
            <tr>
                <td><?= $no++ ?></td>

                <td><b><?= $row['nama'] ?></b></td>

                <td><?= $row['username'] ?? '-' ?></td>

                <td>
                    <span class="badge bg-primary">
                        <?= $row['paket'] ?? '-' ?>
                    </span>
                </td>

                <td><?= $row['alamat'] ?? '-' ?></td>

                <td><?= $row['group_pelanggan'] ?? '-' ?></td>

                <td><?= $row['wa'] ?? '-' ?></td>

                <td>
                    <?php if(($row['status'] ?? 'offline') == 'online') { ?>
                        <span class="text-success">● Online</span>
                    <?php } else { ?>
                        <span class="text-danger">● Offline</span>
                    <?php } ?>
                </td>

                <td class="text-center">
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i>
                    </a>

                    <a href="hapus.php?id=<?= $row['id'] ?>" 
                       onclick="return confirm('Hapus data?')" 
                       class="btn btn-sm btn-danger">
                        <i class="bi bi-x"></i>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- 🔥 INFO DATA -->
    <div class="mt-2">
        <small class="text-muted">
            Menampilkan <?= $start+1 ?> - <?= min($start+$limit, $total) ?> 
            dari <?= $total ?> pelanggan
        </small>
    </div>

    <!-- 🔢 PAGINATION -->
    <div class="mt-3 text-center">

        <?php if($page > 1) { ?>
            <a href="?page=<?= $page-1 ?>" class="btn btn-sm btn-secondary">Prev</a>
        <?php } ?>

        <?php for($i=1; $i <= $pages; $i++) { ?>
            <a href="?page=<?= $i ?>" 
               class="btn btn-sm <?= ($i == $page) ? 'btn-primary' : 'btn-outline-primary' ?>">
                <?= $i ?>
            </a>
        <?php } ?>

        <?php if($page < $pages) { ?>
            <a href="?page=<?= $page+1 ?>" class="btn btn-sm btn-secondary">Next</a>
        <?php } ?>

    </div>

</div>

<!-- 🔍 SEARCH SCRIPT -->
<script>
document.getElementById("search").addEventListener("keyup", function() {
    var value = this.value.toLowerCase();
    var rows = document.querySelectorAll("#tabel tbody tr");

    rows.forEach(function(row) {
        row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
    });
});
</script>

<?php include "layout/footer.php"; ?>
