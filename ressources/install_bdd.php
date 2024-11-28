<?php
$username = "doadmin";
$password ="" ;

$hostname = "db-postgresql-fra1-67877-do-user-18442126-0.f.db.ondigitalocean.com";
$port = "25060";
$db_name = "users";

echo "test";
$conn = pg_connect("host=$hostname port=$port dbname=$db_name user=$username password=$password");

if (!$conn) {
    die("Erreur de connexion : " . pg_last_error());
}


$queri = "CREATE TABLE users (
    username VARCHAR(50) NOT NULL PRIMARY KEY,
    prenom VARCHAR(30) NOT NULL,
    nom VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    birthdate DATE,
    sexe VARCHAR(1) CHECK (sexe IN ('M', 'F', 'O'))
    )";

if(pg_exec($conn, $queri)){
    echo "Table users created successfully";
}else{
    echo "Error creating table: " . pg_last_error();
}


echo "Connection successful";

pg_close($conn);

