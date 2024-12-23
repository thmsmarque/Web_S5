<?php
session_start();
include '../../ressources/bdd/config_bdd.php';

if (empty($_POST['username']) || empty($_POST['password'])) {
    $_SESSION['errorConnexion'] = 'Veuillez remplir tous les champs';
    header("Location: ../index.php");
    exit();
}



$conn = get_db_connection($db_config);



$username = $_POST['username'];
$password = $_POST['password'];


$queryRequest = "SELECT password FROM users WHERE username = '$username'";
$result = $conn -> query($queryRequest);


if ($result-> rowCount()> 0) {
    $row = $result->fetch();
    if (password_verify($password, $row['password'])) {
        #$_SESSION['isRegistered'] = true;
        $_SESSION['activeUser'] = $username;
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['errorConnexion'] = 'Nom d\'utilisateur ou mot de passe incorrect';
    header("Location: ../index.php");
    exit();
    }
} else {
    $_SESSION['errorConnexion'] = 'Nom d\'utilisateur ou mot de passe incorrect';
    header("Location: ../index.php");
    exit();
}



?>