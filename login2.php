<?php
session_start();

// Connexion à la base de données avec PDO
try {
    require('connect.php');
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
  
    try {
        // Préparation de la requête SQL
        $query = $db->prepare("SELECT * FROM utilisateur WHERE nom=:username");

        // Liaison des paramètres
        $query->bindParam(':username', $username);

        // Exécution de la requête
        $query->execute();

        // Récupération des résultats
        $user = $query->fetch(PDO::FETCH_ASSOC);
        
        // Vérification des données utilisateur
        echo "Données de l'utilisateur : ";
        print_r($user);
        if ($user) {
            // Vérification du mot de passe
            echo "Mot de passe hashé depuis la base de données : " . $user['motpasse'] . "<br>";
            echo "Mot de passe saisi par l'utilisateur : " . $password . "<br>";
            
            $password_match = password_verify($password, $user['motpasse']);
            echo "Le mot de passe correspond : " . ($password_match ? 'true' : 'false') . "<br>";
            
            if ($password_match) {
                $_SESSION['username'] = $username;
                header("Location: accueil.php");
                exit(); // Assurez-vous de terminer l'exécution du script après la redirection
            } else {
                $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
            }
        } else {
            $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
        }    
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    
</body>
</html>
<form class="box" action="" method="post" name="login">
<h1 class="box-title">Connexion</h1>
<input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
<input type="password" class="box-input" name="password" placeholder="Mot de passe">
<input type="submit" value="Connexion" name="submit" class="box-button">
<p class="box-register">Vous êtes nouveau ici? <a href="inscription.php">S'inscrire</a></p>
<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>
</form>
