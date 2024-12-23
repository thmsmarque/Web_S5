<?php
$username = "doadmin";
$password ="AVNS_OjyAFT-cKCKy91FQfBg" ;

$hostname = "db-mysql-fra1-45664-do-user-18442126-0.h.db.ondigitalocean.com";
$port = "25060";
$db_name = "users";

echo "test";
$conn = mysqli_connect($hostname, $username, $password, $db_name, $port);






$queri = "CREATE TABLE boisson (
    id_boisson SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    recette TEXT,
    preparation TEXT
    );
    CREATE TABLE categorie (
    id_categorie SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
    );
    CREATE TABLE index(
    id_boisson INT REFERENCES boisson(id_boisson),
    id_categorie INT REFERENCES categorie(id_categorie),
    niveau INT NOT NULL
   );";



include 'Donnees.inc.php';
/*
foreach ($Recettes as $recette) {
    $nom = pg_escape_string($recette['titre']);
    $ingredients = pg_escape_string($recette['ingredients']);
    $preparation = pg_escape_string($recette['preparation']);
    
    $query = "INSERT INTO boisson (nom, recette, preparation) VALUES ('$nom', '$ingredients', '$preparation')";
    pg_exec($conn, $query);
}



foreach ($Recettes as $recette) {
    foreach ($recette['index'] as $categorie) {
        $nom = pg_escape_string($categorie);
        $query_check = "SELECT id_categorie FROM categorie WHERE nom = '$nom'";
        $result_check = pg_query($conn, $query_check);

        if (!$result_check) {
            die("Erreur lors de la vérification de la catégorie : " . pg_last_error());
        }

        if (pg_num_rows($result_check) == 0) {
            $query_insert = "INSERT INTO categorie (nom) VALUES ('$nom')";
            $result_insert = pg_query($conn, $query_insert);

            if (!$result_insert) {
                die("Erreur lors de l'insertion de la catégorie : " . pg_last_error());
            }

            pg_free_result($result_insert);
        }

        pg_free_result($result_check);
    }
}*/

$queri = "SELECT * FROM boisson";

$result = mysqli_query($conn, $queri);

if(mysqli_num_rows($result) > 0){
    echo "Tables boisson ok successfully";
}else{
    echo "Error creating table: " . pg_last_error();
}

$queri = "SELECT * from categorie";
$result = mysqli_query($conn, $queri);

if(mysqli_num_rows($result) > 0){
    echo "Tables categorie successfully";
}else{
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);

?>