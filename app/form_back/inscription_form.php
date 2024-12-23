<?php
session_start();
include '../../ressources/bdd/config_bdd.php';

if (empty($_POST['prenom']) || empty($_POST['nom']) || empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
    $_SESSION['error'] = 'Veuillez remplir tous les champs';
    header("Location: ./inscription.php");
    $_SESSION['form_data'] = $_POST;
    exit();
} else {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
}



$conn = get_db_connection($db_config);


//Test si l'mail est déjà utilisé
$queryRequest = "SELECT * FROM users WHERE upper(email) like ('$email')";
$stmt = $conn -> query($queryRequest);
if ($stmt->rowCount() > 0) {
    $_SESSION['error'] = 'Cet email est déjà utilisé';
    header("Location: ../inscription.php");
    exit();
}
//Test si le nom d'utilisateur est déjà utilisé
$queryRequest = "SELECT * FROM users WHERE upper(username) like upper('$username')";
$stmt = $conn -> query($queryRequest);
if ($stmt->rowCount() > 0) {
    $_SESSION['error'] = 'Ce nom d\'utilisateur est déjà utilisé';
    header("Location: ../inscription.php");
    exit();
}

// Hacher le mot de passe
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

//Sinon on inscrit l'utilisateur
$queryRequest = "INSERT INTO users (prenom, nom, username, email, password) VALUES ('$prenom', '$nom', '$username', '$email', '$hashedPassword')";
if ($conn->exec($queryRequest)) {
    $_SESSION['error'] = 'Inscription réussie';
    header("Location: ../index.php");
    exit();
} else {
    $_SESSION['error'] = 'Une erreur est survenue, veuillez réessayer plus tard';
    header("Location: ../inscription.php");
    exit();
}
?>