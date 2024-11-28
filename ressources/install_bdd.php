<?php
$hostname = "sql308.byethost16.com";
$username = "b16_37711947";
$password = "";
$db_name = "b16_37711947_users";

echo "test";

$conn = mysqli_connect($hostname, $username, $password, $db_name);

if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

echo "Connection successful";

mysqli_close($conn);

