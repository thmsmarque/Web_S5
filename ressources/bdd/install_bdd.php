<?php

include './config_bdd.php';

$conn = get_db_connection($db_config);


/*

$queries = [
    "CREATE TABLE users (
        username VARCHAR(50) NOT NULL PRIMARY KEY,
        prenom VARCHAR(30) NOT NULL,
        nom VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        password VARCHAR(50) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        birthdate DATE,
        sexe VARCHAR(1) CHECK (sexe IN ('M', 'F', 'O'))
    )",
    "CREATE TABLE boissons (
        id_boisson SERIAL PRIMARY KEY,
        titre VARCHAR(200) NOT NULL,
        ingredients VARCHAR(1000) NOT NULL,
        preparation VARCHAR(1000) NOT NULL
    )",
    "CREATE TABLE categories (
        id_categorie SERIAL PRIMARY KEY,
        nom VARCHAR(50) NOT NULL
    )",
    "CREATE TABLE appartenir (
        id_boisson INT REFERENCES boissons(id_boisson),
        id_categorie INT REFERENCES categories(id_categorie),
        index_level INTEGER,
        primary key(id_boisson, id_categorie)
    )",
    "CREATE TABLE preferer (
        username VARCHAR(50) REFERENCES users(username),
        id_boisson INT REFERENCES boissons(id_boisson),
        PRIMARY KEY (username, id_boisson)
    )",
    "CREATE TABLE souscategorie(
        parent INT REFERENCES categories(id_categorie),
        enfant INT REFERENCES categories(id_categorie),
        index_level INTEGER,
        primary key(parent, enfant)
    )",
    "CREATE TABLE supercategorie(
        parent INT REFERENCES categories(id_categorie),
        supercat INT REFERENCES categories(id_categorie),
        index_level INTEGER,
        primary key(parent, supercat)
    )"
];



    foreach ($queries as $query) {
        if ($conn->exec($query) === false) {
            echo "Error creating tables";
        } else {
            echo "Tables created successfully";
        }
    }
    include './Donnees.inc.php';

    foreach($Hierarchie as $categorie => $souscategories){
        echo "Categorie : ".$categorie."<br>";
    }

    
    
    try {
        // Insérer les catégories dans la base de données
        $categories = [];
        foreach ($Hierarchie as $categorie => $souscategories) {
            echo "Categorie : ".$categorie."<br>";
            $nom = $conn->quote($categorie);
            $query = "INSERT INTO categories (nom) VALUES ($nom)";
            $conn->exec($query);
            $categories[$categorie] = $conn->lastInsertId();
        }
    
        // Insérer les sous-catégories et super-catégories
        foreach ($Hierarchie as $categorie => $souscategories) {
            if (isset($souscategories['sous-categorie'])) {
                $index_level = 0;
                foreach ($souscategories['sous-categorie'] as $souscategorie) {
                    echo "Sous-categorie : ".$souscategorie."<br>";
                    $parent_id = $categories[$categorie];
                    $enfant_id = $categories[$souscategorie];
                    $query = "INSERT INTO souscategorie (parent, enfant, index_level) VALUES ($parent_id, $enfant_id,$index_level)";
                    $conn->exec($query);
                    $index_level++;
                }
            }
            if (isset($souscategories['super-categorie'])) {
                $index_level = 0;
                foreach ($souscategories['super-categorie'] as $supercategorie) {
                    echo "Super-categorie : ".$supercategorie."<br>";
                    $parent_id = $categories[$categorie];
                    $enfant_id = $categories[$supercategorie];
                    $query = "INSERT INTO supercategorie (parent, supercat, index_level) VALUES ($parent_id, $enfant_id,$index_level)";
                    $conn->exec($query);
                    $index_level++;
                }
            }
        }
        
    
        // Insérer les boissons et les relations avec les catégories
        foreach ($Recettes as $recette) {
            $titre = $conn->quote($recette['titre']);
            $ingredients = $conn->quote($recette['ingredients']);
            $preparation = $conn->quote($recette['preparation']);
            
            $query = "INSERT INTO boissons (titre, ingredients, preparation) VALUES ($titre, $ingredients, $preparation)";
            $conn->exec($query);
            $boisson_id = $conn->lastInsertId();
    
            foreach ($recette['index'] as $categorie) {
                $index_level = 0;
                if (isset($categories[$categorie])) {
                    $categorie_id = $categories[$categorie];
                    
                    // Vérifier si la paire (id_boisson, id_categorie) existe déjà
                    $check_query = "SELECT COUNT(*) FROM appartenir WHERE id_boisson = $boisson_id AND id_categorie = $categorie_id";
                    $stmt = $conn->query($check_query);
                    $count = $stmt->fetchColumn();
    
                    if ($count == 0) {
                        $query = "INSERT INTO appartenir (id_boisson, id_categorie, index_level) VALUES ($boisson_id, $categorie_id, $index_level)";
                        $conn->exec($query);
                    }
                }
            }
        }
        echo "Remplissage de la base de données terminé avec succès.";
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }*/

    $souscategories = get_sous_cat_de($conn, 'Liquide');
    foreach ($souscategories as $souscategorie) {
        echo $souscategorie['sous_categorie'] . "<br>";
    }

    $supercategories = get_super_cat_de($conn, 'Liquide');
    foreach ($supercategories as $supercategorie) {
        echo $supercategorie['super_categorie'] . "<br>";
    }

    $boissons = get_boisson_from_cat($conn, 'Sel');
    foreach ($boissons as $boisson) {
        echo $boisson['titre'] . "<br>";
    }

    $conn = null; // Close connection




