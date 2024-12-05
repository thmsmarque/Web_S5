<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 
    <link rel="stylesheet" href="inscription.css">
     -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d\'inscription</title>
</head>

<body>
    <a href="index.php" class="back-button">Retour à la page principale</a>
    <div class="boite-inscription" style='text-align:center'>
        <form action="inscription_form.php" method="post">
            <div class="titre">Inscription</div>
            <div class="error">
                <?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
            </div>
            PRENOM<input type="text" name="prenom" id="prenom"><br>
            NOM:<input type="text" name="nom" id="nom"><br>
            EMAIL:<input type="email" name="email" id="email"><br>
            NOM D'UTILISATEUR:<input type="text" name="username" id="username"><br>
            MOT DE PASSE:<input type="password" name="password" id="password"><br>
            <input type="submit" value="inscription" class="submit-button">
        </form>
    </div>
</body>

</html>