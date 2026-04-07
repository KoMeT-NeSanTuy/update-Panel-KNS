<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$current = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>
<head>
<title>KNS Panel</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body { margin:0; font-family:'Segoe UI'; background:#f5f6fa; }

/* SIDEBAR */
.sidebar {
    width:250px;
    height:100vh;
    position:fixed;
    background:#fff;
    border-right:1px solid #eee;
    transition:0.3s;
}
.sidebar.collapsed { width:70px; }

/* LOGO */
.logo { padding:15px; font-weight:bold; color:#6c5ce7; }

/* MENU */
.menu { overflow-y:auto; height:calc(100vh - 120px); }

.menu-title {
    font-size:11px;
    color:#aaa;
    padding:10px 20px 5px;
}

.menu a {
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:10px 20px;
    text-decoration:none;
    color:#333;
}

.menu a:hover { background:#f1f2f6; }

.menu a.active {
    background:#eef1ff;
    color:#6c5ce7;
    border-left:3px solid #6c5ce7;
}

/* SUBMENU */
.submenu { display:none; background:#fafafa; }
.submenu a { padding-left:40px; font-size:13px; }
.submenu.show { display:block; }

/* TOPBAR */
.topbar {
    height:50px;
    background:#fff;
    border-bottom:1px solid #eee;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 15px;
}

/* CONTENT */
.content {
    margin-left:250px;
    padding:20px;
    transition:0.3s;
}
.content.full { margin-left:70px; }

/* DARK MODE */
body.dark { background:#1e1e2f; color:#ddd; }
body.dark .sidebar { background:#2a2a40; }
body.dark .menu a { color:#ddd; }
body.dark .menu a.active { background:#44446a; }
body.dark .topbar { background:#2a2a40; }

/* MOBILE */
@media (max-width:768px) {
    .sidebar { left:-250px; }
    .sidebar.show { left:0; }
    .content { margin-left:0; }
}
</style>

</head>

<body>

<!-- TOPBAR -->
<div class="topbar">
    <button class="btn btn-sm btn-light" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <button class="btn btn-sm btn-dark" onclick="toggleDarkMode()" id="btnTheme">
        <i class="bi bi-moon"></i>
    </button>
</div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">

<div class="logo">KNS PANEL</div>

<div class="menu">

    <!-- DASHBOARD -->
    <div class="menu-title">MENU</div>
    <a href="dashboard.php" class="<?= $current=='dashboard.php'?'active':'' ?>">
        <span><i class="bi bi-house"></i> Dashboard</span>
    </a>

    <!-- CRM -->
    <div class="menu-title">CRM</div>

    <a href="#" onclick="toggleMenu('crm')">
        <span><i class="bi bi-people"></i> Pelanggan</span>
        <i class="bi bi-chevron-down"></i>
    </a>

    <div class="submenu" id="crm">
        <a href="pelanggan.php" class="<?= $current=='pelanggan.php'?'active':'' ?>">Client</a>
        <a href="map.php" class="<?= $current=='map.php'?'active':'' ?>">Map</a>
    </div>

    <!-- INFRA -->
    <div class="menu-title">INFRASTRUKTUR</div>

    <a href="#" onclick="toggleMenu('infra')">
        <span><i class="bi bi-diagram-3"></i> Network</span>
        <i class="bi bi-chevron-down"></i>
    </a>

    <div class="submenu" id="infra">
        <a href="#">OLT</a>
        <a href="#">ODC</a>
        <a href="#">ODP</a>
    </div>

    <!-- SERVICES -->
    <div class="menu-title">SERVICES</div>

    <a href="#" onclick="toggleMenu('service')">
        <span><i class="bi bi-box"></i> Paket</span>
        <i class="bi bi-chevron-down"></i>
    </a>

    <div class="submenu" id="service">
        <a href="#">Paket Internet</a>
        <a href="#">Add-On</a>
    </div>

    <!-- FINANCE -->
    <div class="menu-title">FINANCE</div>

    <a href="#">
        <span><i class="bi bi-cash"></i> Keuangan</span>
    </a>

    <!-- ADMIN -->
    <div class="menu-title">ADMIN</div>

    <a href="#">
        <span><i class="bi bi-person"></i> Karyawan</span>
    </a>

    <a href="#">
        <span><i class="bi bi-gear"></i> Pengaturan</span>
    </a>

</div>

<div class="p-3 border-top">
    <small><?= $_SESSION['name'] ?></small>
    <a href="logout.php" class="btn btn-danger btn-sm w-100 mt-2">Logout</a>
</div>

</div>

<!-- CONTENT -->
<div class="content" id="content">
