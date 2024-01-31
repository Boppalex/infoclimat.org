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
    $dbName = "basetest";

    // Connexion à la base de données
    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Échapper les valeurs pour éviter les injections SQL (utilisez les déclarations préparées pour une sécurité optimale)
    $escapedUsername = $conn->real_escape_string($username);
    $escapedPassword = $conn->real_escape_string($password);

    // Requête pour vérifier les informations d'identification dans la base de données
    $query = "SELECT * FROM user WHERE username='$escapedUsername' AND password='$escapedPassword'";
    $result = $conn->query($query);

    // Fermer la connexion à la base de données
    $conn->close();

    // Vérifier si la requête a renvoyé une correspondance
    return ($result->num_rows > 0);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($errorMessage)) { ?>
        <p><?php echo $errorMessage; ?></p>
    <?php } ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
