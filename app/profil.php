<?php
session_start();
if(!isset($_SESSION['activeUser'])){
    $_SESSION['errorConnexion'] = 'Vous devez être connecté pour accéder à cette page';
    header("Location: index.php");
    exit();
}


$username = "doadmin";
$password ="" ;

$hostname = "db-postgresql-fra1-67877-do-user-18442126-0.f.db.ondigitalocean.com";
$port = "25060";
$db_name = "users";

$conn = mysqli_connect($hostname, $usernamedb, $passworddb, $db_name);

if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
    $_SESSION['errorConnexion'] = 'Une erreur est survenue, veuillez réessayer plus tard';
    header("Location: index.php");
    exit();
}


$queryRequest = "SELECT * FROM users WHERE username = '" . $_SESSION['activeUser'] . "'";
$result = mysqli_query($conn, $queryRequest);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    $_SESSION['errorConnexion'] = 'Une erreur est survenue, veuillez réessayer plus tard';
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de</title>

    <link rel="stylesheet" href="profil-page.css">
</head>
<body>
    <header>
        <div class=bouton-retour-profil>
            <a href="index.php">Retour à la page principale</a>
        </div>
        <div class="bouton-deconnexion">
        <form>
         <input type="deconnexion" value="deconnexion" onclick="window.location.href ='deconnexion_form.php'" style="color:red"></input>
        </form>
        </div>
    </header>
    <h1>Profil de <?php echo $row['prenom']; $row['nom']; ?></h1>
</body>
</html>