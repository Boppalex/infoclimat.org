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
        //echo "Données de l'utilisateur : ";
        //print_r($user);
        if ($user) {
            // Vérification du mot de passe
            //echo "Mot de passe hashé depuis la base de données : " . $user['motpasse'] . "<br>";
            // echo "Mot de passe saisi par l'utilisateur : " . $password . "<br>";
            
            $password_match = password_verify($password, $user['motpasse']);
            // echo "Le mot de passe correspond : " . ($password_match ? 'true' : 'false') . "<br>";
            
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Ajoutez la CDN de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-semibold mb-4 text-center">Login</h2>
        <?php if (isset($errorMessage)) { ?>
            <p class="text-red-500 text-center">
                <?php echo $errorMessage; ?>
            </p>
        <?php } ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username" class="block mb-2">Username:</label>
            <input type="text" id="username" name="username" class="w-full p-2 mb-4 border border-gray-300 rounded"
                required>

            <label for="password" class="block mb-2">Password:</label>
            <input type="password" id="password" name="password" class="w-full p-2 mb-4 border border-gray-300 rounded"
                required>

            <div class="flex flex-row gap-2">
                <button type="submit" class="btn w-full bg-green-500 text-white p-2 rounded hover:bg-green-600">
                    Login
                </button>
                <a href="Inscription.php" class="btn w-full bg-green-500 text-white text-center p-2 rounded hover:bg-green-600">
                    <button type="button">
                        Inscription
                    </button>
                </a>
            </div>

        </form>
    </div>
</body>

</html>
