<?php
// Démarrez la session
session_start();

// Détruire toutes les variables de session
$_SESSION = array();

// Détruire la session
session_destroy();

// Rediriger vers la page d'accueil avec un message d'alerte
header('Location: accueil.php');

exit;
?>
