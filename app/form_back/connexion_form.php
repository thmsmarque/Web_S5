<?php
session_start();

if (empty($_POST['username']) || empty($_POST['password'])) {
    $_SESSION['errorConnexion'] = 'Veuillez remplir tous les champs';
    header("Location: ./index.php");
    exit();
}

$usernamedb = "doadmin";
$passworddb ="AVNS_DMhcFupGGjku7Gy1nMn" ;

$hostname = "db-postgresql-fra1-67877-do-user-18442126-0.f.db.ondigitalocean.com";
$port = "25060";
$db_name = "users";

$conn = mysqli_connect($hostname, $username, $password, $db_name, $port);

if (!$conn) {
    die("Erreur de connexion : " . pg_last_error());
    $_SESSION['error'] = 'Une erreur est survenue, veuillez réessayer plus tard';
    header("Location: ./index.php");
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

$queryRequest = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = pg_query($conn, $queryRequest);
if (pg_num_rows($result) > 0) {
    #$_SESSION['isRegistered'] = true;
    $_SESSION['activeUser'] = $username;
    header("Location: ./index.php");
    exit();
} else {
    $_SESSION['errorConnexion'] = 'Nom d\'utilisateur ou mot de passe incorrect';
    header("Location: ./index.php");
    exit();
}



?>