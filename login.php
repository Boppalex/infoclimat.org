<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le nom d'utilisateur et le mot de passe du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Ajouter votre logique de validation ici
    if (validateCredentials($username, $password)) {
        // Si les informations d'identification sont valides, rediriger vers la page d'accueil
        $_SESSION["username"] = $username;
        header("Location: backend.php");
        exit();
    } else {
        // Si les informations d'identification ne sont pas valides, afficher un message d'erreur
        $errorMessage = "Invalid username or password";
    }
}
// Fonction de validation des informations d'identification avec interrogation de la base de données
function validateCredentials($username, $password) {
    // Remplacez ces informations par celles de votre base de données
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "infoclimat";

    // Connexion à la base de données
    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Utilisation d'une requête préparée pour éviter les injections SQL
    $query = "SELECT * FROM utilisateur WHERE nom=? AND motpasse=?";
    
    // Préparer la requête
    $stmt = $conn->prepare($query);
    
    // Vérifier si la préparation a échoué
    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }

    // Lier les paramètres
    $stmt->bind_param("ss", $username, $password);

    // Exécuter la requête
    $stmt->execute();

    // Récupérer le résultat
    $result = $stmt->get_result();

    // Fermer la connexion à la base de données
    $stmt->close();
    $conn->close();

    // Vérifier si la requête a renvoyé une correspondance
    return ($result->num_rows > 0);
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
            <p class="text-red-500 text-center"><?php echo $errorMessage; ?></p>
        <?php } ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username" class="block mb-2">Username:</label>
            <input type="text" id="username" name="username" class="w-full p-2 mb-4 border border-gray-300 rounded" required>
            
            <label for="password" class="block mb-2">Password:</label>
            <input type="password" id="password" name="password" class="w-full p-2 mb-4 border border-gray-300 rounded" required>
            
            <button type="submit" class="w-full bg-green-500 text-white p-2 rounded hover:bg-green-600">Login</button>
        </form>
    </div>
</body>
</html>
