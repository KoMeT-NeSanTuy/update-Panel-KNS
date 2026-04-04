<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>KNS Panel</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body { margin:0; }

.sidebar {
    width:250px;
    height:100vh;
    position:fixed;
    background:#212529;
    color:white;
    display:flex;
    flex-direction:column;
}

.sidebar .menu {
    flex:1;
}

.sidebar a {
    display:block;
    color:white;
    padding:10px;
    text-decoration:none;
}

.sidebar a:hover {
    background:#343a40;
}

.user-box {
    background:#343a40;
    padding:10px;
    text-align:center;
}

.content {
    margin-left:250px;
    padding:20px;
}
</style>

</head>

<body>

<div class="sidebar">

    <div class="p-3">
        <h4>KNS</h4>
    </div>

    <div class="menu">
        <a href="index.php"><i class="bi bi-speedometer"></i> Dashboard</a>
        <a href="routers.php"><i class="bi bi-router"></i> Router</a>
    </div>

    <!-- 🔥 USER INFO -->
    <div class="user-box">
        <small>Login sebagai</small><br>
        <strong><?= $_SESSION['name'] ?></strong><br><br>

        <a href="logout.php" class="btn btn-danger btn-sm w-100">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

</div>

<div class="content">
