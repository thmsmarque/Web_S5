<?php
       session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Index</title>
    <link rel="stylesheet" href="../style/style.css" />

    <script language ="javascript" type="text/javascript">
    


    function deconnexion()
    {
        window.location.href = 'form_back/deconnexion_form.php';
    }
    function connexion()
    {
        <?php
        $_SESSION['isRegistered'] = true;
        ?>
        window.location.reload();
    }
    function afficherConnexion()
    {
        let loginbuttons = document.getElementsByClassName("inputfields-for-login");
        for (let i = 0; i < loginbuttons.length; i++) {
            loginbuttons[i].style.display = 'block';
        }
    }

</script>
</head>

<body>
    <header class="bandeau">
        <div style="display: flex; justify-content: space-between; align-items: center;" class ="upper-bandeau">
            <h1>
                Drink-drink !
            </h1>
            <nav>
                <form>
                    <input type="search" name="q" placeholder="La boisson de vos rêves..." />
                    <input type="submit" value="Go" />
                </form>
            </nav>

            <div class="login-buttons">
                <div class="errorDisplay">
                    <?php
                    if (isset($_SESSION['errorConnexion'])) {
                        echo $_SESSION['errorConnexion'];
                        unset($_SESSION['errorConnexion']);
                    }
                    ?>
                <form action="form_back/connexion_form.php" method="post">
                    <?php
                    #echo($_SESSION['isRegistered']);
                    #echo(isset($_SESSION['isRegistered']));
                    #echo($_SESSION["activeUser"]);
                    if (isset($_SESSION['activeUser'])) {
                        #echo '<button type="button" onclick="deconnexion()">Déconnexion</button>';
                        echo'<a href="form_back/profil.php" class="deconnexion">Profil</a>';
                    } else {
                        echo '<div class="inputfields-for-login"><input type="text" name="username" id="username" placeholder="Nom d\'utilisateur"><input type="password" name="password" id="password" placeholder="Mot de passe">';
                        echo '<button type="submit"}">Connexion</button>';
                        echo '<button type="button" onclick="window.location.href=\'inscription.php\'">Inscription</button></div>';
                        
                    }
                    ?>
                </form>
            </div>
        </div>
        <div class="lower-bandeau">

        </div>
    </header>
    <main> <!-- Contenu de la page -->
        <article class="recette_contenu">
            <article class="titre_recette">
                <?php
                include '../ressources/Donnees.inc.php';
                /* Récupérer les titres : */
                foreach ($Recettes as $recette) {
                    echo $recette['titre'];
                    echo "<br>";
                }
                ?>
            </article>
        </article>
    </main>
</body>

</html>