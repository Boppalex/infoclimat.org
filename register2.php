<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require('connect.php');
if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])){
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    
    // Création de la requête préparée
    $query = "INSERT INTO utilisateur (nom, motpasse) VALUES (:username, :password)";
    $stmt = $db->prepare($query);
    
    // Liaison des valeurs aux paramètres de la requête préparée
    $stmt->bindParam(':username', $username);
    $hashed_password = hash('sha256', $password);
    $stmt->bindParam(':password', $hashed_password);
    
    // Exécution de la requête préparée
    $res = $stmt->execute();
    
    if($res){
       echo "<div class='success'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
       </div>";
    }
}else{
?>
<form class="box" action="" method="post">
    <h1 class="box-title">S'inscrire</h1>
    <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
    <input type="text" class="box-input" name="email" placeholder="Email" required />
    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
    <input type="submit" name="submit" value="S'inscrire" class="box-button" />
    <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
</form>
<?php } ?>
</body>
</html>
