<?php
try {
    // Connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=infoclimat', 'root', '');
    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
    die();
}
?>