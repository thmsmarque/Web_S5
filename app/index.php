<!DOCTYPE html>
<html>

<head>
    <title>Index</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <header class="bandeau">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>
                Drink-drink !
            </h1>
            <nav>
                <form>
                    <input type="search" name="q" placeholder="La boisson de vos rêves..." />
                    <input type="submit" value="Go" />
                </form>
            </nav>
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