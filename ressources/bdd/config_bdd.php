<?php
// Informations de connexion à la base de données
$db_config = [
    'username' => 'doadmin',
    'password' => 'AVNS_OjyAFT-cKCKy91FQfBg',
    'hostname' => 'db-mysql-fra1-45664-do-user-18442126-0.h.db.ondigitalocean.com',
    'port' => '25060',
    'dbname' => 'defaultdb',
];

// Fonction pour établir la connexion à la base de données
function get_db_connection($config) {
    try {
        $dsn = "mysql:host={$config['hostname']};port={$config['port']};dbname={$config['dbname']}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdo = new PDO($dsn, $config['username'], $config['password'], $options);
        return $pdo;
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
}

function get_sous_cat_de($conn, $cat) {
    $query = "SELECT c2.nom AS sous_categorie
        FROM categories c1
        JOIN souscategorie sc ON c1.id = sc.parent
        JOIN categories c2 ON sc.enfant = c2.id
        WHERE upper(c1.nom) = upper('$cat')";
    $stmt = $conn->query($query);
    $souscategories = $stmt->fetchAll();
    return $souscategories;
}

function get_super_cat_de($conn, $cat) {
    $query = "SELECT c2.nom AS super_categorie
        FROM categories c1
        JOIN supercategorie sc ON c1.id = sc.parent
        JOIN categories c2 ON sc.enfant = c2.id
        WHERE upper(c1.nom) = upper('$cat')";
    $stmt = $conn->query($query);
    $supercategories = $stmt->fetchAll();
    return $supercategories;
}

function get_boisson_from_cat($conn, $cat) {
    $id = getid_from_cat($conn, $cat);
    $query = "SELECT b.titre, b.ingredients, b.preparation
        FROM boissons b
        JOIN appartenir a ON b.id = a.id_boisson
        JOIN categories c ON a.id_categorie = c.id
        WHERE c.id = '$id'";
    $stmt = $conn->query($query);
    $boissons = $stmt->fetchAll();
    return $boissons;
}


function getid_from_cat($conn, $cat) {
    $query = "SELECT c.id
        FROM categories c
        WHERE upper(c.nom) = upper('$cat')";
    $stmt = $conn->query($query);
    $id = $stmt->fetchColumn();
    return $id;
}