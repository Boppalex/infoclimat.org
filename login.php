<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require('connect.php');

    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        $query = $db->prepare("SELECT * FROM utilisateur WHERE nom=:username");
        $query->bindParam(':username', $username);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $password_match = password_verify($password, $user['motpasse']);
            if ($password_match) {
                $_SESSION["user_id"] = $user['id'];
                $_SESSION["username"] = $username;
                header("Location: accueil.php");
                exit();
            } else {
                $errorMessage = "Invalid username or password";
            }
        } else {
            $errorMessage = "Invalid username or password";
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
            <div class="flex flex-row gap-2">
                <button type="submit" class="btn w-full bg-green-500 text-white p-2 rounded hover:bg-green-600">Login</button>
                <a href="Inscription.php" class="btn w-full bg-green-500 text-white text-center p-2 rounded hover:bg-green-600">
                    <button type="button">Inscription</button>
                </a>
            </div>
        </form>
    </div>
</body>
</html>
