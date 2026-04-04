<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "config.php";

if (isset($_POST['username'])) {
    $u = $_POST['username'];
    $p = md5($_POST['password']);

    $q = $conn->query("SELECT * FROM users WHERE username='$u' AND password='$p'");

    if ($q && $q->num_rows > 0) {
        $user = $q->fetch_assoc();

        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['full_name'];

        header("Location: index.php");
        exit;
    } else {
        $error = "Login gagal";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login KNS Panel</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background:#212529;
}
.login-box {
    width:350px;
    margin:auto;
    margin-top:150px;
    background:white;
    padding:30px;
    border-radius:10px;
}
</style>

</head>

<body>

<div class="login-box">
<h3 class="text-center mb-3">KNS PANEL</h3>

<?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

<form method="POST">
<input class="form-control mb-2" name="username" placeholder="Username">
<input class="form-control mb-2" type="password" name="password" placeholder="Password">
<button class="btn btn-dark w-100">Login</button>
</form>

</div>

</body>
</html>
