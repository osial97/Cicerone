<?php

$db_host = "localhost";
$db_user = "phpmyadminuser";
$db_pass = "password";
$db_name = "my_cicer1";

try {
    //create PDO connection
    global $db;
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch(PDOException $e) {
    //show error
    die("Errore di connessione!: " . $e->getMessage());
}
