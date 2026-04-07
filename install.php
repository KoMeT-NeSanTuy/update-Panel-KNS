<?php

if(isset($_POST['install'])){

    $host = $_POST['host'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $db   = $_POST['db'];

    $conn = new mysqli($host,$user,$pass);

    if($conn->connect_error){
        die("Koneksi gagal");
    }

    $conn->query("CREATE DATABASE IF NOT EXISTS $db");

    $conn->select_db($db);

    $sql = file_get_contents("database.sql");
    $conn->multi_query($sql);

    $config = "<?php
\$DB_HOST='$host';
\$DB_USER='$user';
\$DB_PASS='$pass';
\$DB_NAME='$db';

\$conn = new mysqli(\$DB_HOST,\$DB_USER,\$DB_PASS,\$DB_NAME);
?>";

    file_put_contents("config.php", $config);

    echo "<h2>Install berhasil</h2>";
    exit;
}
?>

<form method="post">
<h2>Install KNS Panel</h2>
Host: <input name="host" value="localhost"><br>
User: <input name="user" value="root"><br>
Pass: <input name="pass"><br>
DB: <input name="db" value="kns_panel"><br>
<button name="install">Install</button>
</form>
