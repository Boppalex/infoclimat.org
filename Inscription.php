<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto py-12">
        <h2 class="text-3xl font-semibold text-center mb-6">Inscription</h2>
        <form method="POST" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-bold mb-2">Nom d'utilisateur:</label>
                <input type="text" id="username" name="username" required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Mot de passe:</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="confirm_password" class="block text-gray-700 font-bold mb-2">Confirmer le mot de
                    passe:</label>
                <input type="password" id="confirm_password" name="confirm_password" required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            
            <div class="flex flex-row gap-2">
                <button type="submit" name="submit"
                    class=" w-full bg-green-500 text-white text-center p-2 rounded hover:bg-green-600">S'inscrire</button>
                <a href="accueil.php"
                    class="btn w-full bg-green-500 text-white text-center p-2 rounded hover:bg-green-600">
                    <button type="button">
                        Retour
                    </button>
                </a>
            </div>
        </form>
        <div class="text-center mt-6">
            <?php
            require_once('connect.php');

            if (isset($_POST['submit'])) {
                if (
                    isset($_POST['username']) && !empty($_POST['username'])
                    && isset($_POST['password']) && !empty($_POST['password'])
                ) {
                    $username = strip_tags($_POST['username']);
                    $password = strip_tags($_POST['password']);
                    $confirm_password = strip_tags($_POST['confirm_password']);

                    // Vérification que les mots de passe correspondent
                    if ($password === $confirm_password) {
                        // Hashage du mot de passe
                        //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        // Préparation de la requête SQL pour insérer l'utilisateur dans la base de données
                        $sql = "INSERT INTO utilisateur (nom, motpasse) VALUES (:username, :password)";

                        // Préparation de la requête
                        $query = $db->prepare($sql);

                        // Liaison des paramètres avec les valeurs postées depuis le formulaire
                        $query->bindParam(':username', $username, PDO::PARAM_STR);
                        $query->bindParam(':password', $password, PDO::PARAM_STR);

                        // Exécution de la requête
                        if ($query->execute()) {
                            echo '<span class="text-green-500">Inscription réussie pour l\'utilisateur : ' . $username . '</span>';
                        } else {
                            echo '<span class="text-red-500">Une erreur s\'est produite lors de l\'inscription.</span>';
                        }
                    } else {
                        echo '<span class="text-red-500">Les mots de passe ne correspondent pas.</span>';
                    }
                } else {
                    echo '<span class="text-red-500">Veuillez remplir tous les champs du formulaire.</span>';
                }
            }

            require_once('close.php');
            ?>
        </div>
    </div>

</body>

</html>
