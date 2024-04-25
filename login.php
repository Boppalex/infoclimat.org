<?php
define("check", "OK");
require_once "passerelle.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le nom d'utilisateur et le mot de passe du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Ajouter votre logique de validation ici
    if (validateCredentials($username, $password)) {
        // Si les informations d'identification sont valides, rediriger vers la page d'accueil
        $userId = getUserId($username);
        $_SESSION["user_id"] = $userId;
        $_SESSION["username"] = $username;

        header("Location: accueil.php");
        exit();
    } else {
        // Si les informations d'identification ne sont pas valides, afficher un message d'erreur
        $errorMessage = "Invalid username or password";
    }
}

// Fonction de validation des informations d'identification avec interrogation de la base de données
function validateCredentials($username, $password)
{
    // Remplacez ces informations par celles de votre base de données
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "infoclimat";

    try {
        // Connexion à la base de données en utilisant PDO
        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);

        // Utilisation d'une requête préparée pour éviter les injections SQL
        $query = "SELECT * FROM utilisateur WHERE nom=:username AND motpasse=:password";

        // Préparer la requête
        $stmt = $conn->prepare($query);

        // Lier les paramètres
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);

        // Exécuter la requête
        $stmt->execute();

        // Récupérer le résultat
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Fermer la connexion à la base de données
        $conn = null;

        // Vérifier si la requête a renvoyé une correspondance
        return ($result !== false);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

// Fonction pour récupérer l'ID de l'utilisateur
function getUserId($username)
{
    // Remplacez ces informations par celles de votre base de données
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "infoclimat";

    try {
        // Connexion à la base de données en utilisant PDO
        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);

        // Utilisation d'une requête préparée pour éviter les injections SQL
        $query = "SELECT id FROM utilisateur WHERE nom=:username";

        // Préparer la requête
        $stmt = $conn->prepare($query);

        // Lier les paramètres
        $stmt->bindParam(":username", $username);

        // Exécuter la requête
        $stmt->execute();

        // Récupérer le résultat
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Fermer la connexion à la base de données
        $conn = null;

        // Récupérer l'ID de l'utilisateur s'il existe
        if ($result !== false) {
            return $result["id"];
        } else {
            return null;
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
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
