<?php

$host = "localhost";
$dbuser = "postgres";
$dbpass = "1234"; // Pastikan ini adalah kata sandi yang benar
$db_name = "db_pendaftaran";

try {
    $db = new PDO("pgsql:host=$host;dbname=$db_name", $dbuser, $dbpass);
    echo "<h3>Sudah Terhubung ke Server</h3>";
} catch (PDOException $e) {
    echo "<h3>Maaf, Server Tidak Terhubung: " . $e->getMessage() . "</h3>";
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect PostgreSQL</title>
</head>
<body>
    <h3>Connect PostgreSQL</h3>
    <hr> 
</body>
</html>
