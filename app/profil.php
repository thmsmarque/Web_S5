<?php
session_start();
if (!isset($_SESSION['activeUser'])) {
    $_SESSION['errorConnexion'] = 'Vous devez être connecté pour accéder à cette page';
    header("Location: index.php");
    exit();
}

include '../ressources/bdd/config_bdd.php';

$conn = get_db_connection($db_config);


$queryRequest = "SELECT * FROM users WHERE username = '" . $_SESSION['activeUser'] . "'";
$result = $conn->query($queryRequest);
if ($result->rowCount() > 0) {
    $infos = $result->fetch();
} else {
    $_SESSION['errorConnexion'] = 'Une erreur est survenue, veuillez réessayer plus tard';
    header("Location: index.php");
    exit();
}

$queryRequest = "SELECT * FROM preferer WHERE username = '" . $_SESSION['activeUser'] . "'";
$result = $conn->query($queryRequest);
if ($result->rowCount() > 0) {
    $boissons = $result->fetchAll();
} else {
    $boissons = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de</title>

    <link rel="stylesheet" href="../style/profil-page.css">
</head>

<body>
    <header>
        <div class=bouton-retour-profil>
            <a href="index.php">Retour à la page principale</a>
        </div>
        <div class="bouton-deconnexion">
            <form>
                <input type="deconnexion" value="deconnexion" onclick="window.location.href ='./form_back/deconnexion_form.php'"
                    style="color:red"></input>
            </form>
        </div>
    </header>
    <h1>Profil de <?php echo $infos['prenom'];
    $infos['nom']; ?></h1>

    <div class="boissons_favorites">
    
    <div class="grille_boisson"></div>
    <?php
    foreach($boissons as $boisson) {
    $boisson_infos = get_boisson_from_id($conn, $boisson['id_boisson']);
    echo '<div class="boisson_panneau">';
    echo '<h2>' . $boisson_infos['titre'] . '</h2>';
    echo '</div>';
    }

    ?>
    </div>
    </div>
</body>

</html>