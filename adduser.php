
<?php
include('header.php');
?>
<?php

require_once('connect.php');


// Vérification de la méthode de requête HTTP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des données du formulaire
    if (
        isset($_POST['titre']) && !empty($_POST['titre'])
        && isset($_POST['description']) && !empty($_POST['description'])
        && isset($_POST['article']) && !empty($_POST['article'])
        && isset($_POST['categorie']) && !empty($_POST['categorie'])
        && isset($_POST['statut']) && !empty($_POST['statut'])
    ) {
        // Nettoyage et récupération des données du formulaire
        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);
        $article = htmlspecialchars($_POST['article']);
        $categorie = htmlspecialchars($_POST['categorie']);
        $statut = htmlspecialchars($_POST['statut']);
        $user_id = $_SESSION['user_id'];

        // Ajout de l'image
        $image = $_FILES['image']['name'];
        $image = file_get_contents($_FILES['image']['tmp_name']);

        // Requête SQL pour insérer un nouvel article dans la table infocarte
        $sql = "INSERT INTO `infocarte` (`titre`, `description`, `article`, `categorie`, `statut`, `image`, `creerpar`) VALUES (:titre, :description, :article, :categorie, :statut, :image, :user_id)";

        // Préparation de la requête
        $query = $db->prepare($sql);

        // Liaison des paramètres
        $query->bindParam(':titre', $titre, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':article', $article, PDO::PARAM_STR);
        $query->bindParam(':categorie', $categorie, PDO::PARAM_STR);
        $query->bindParam(':statut', $statut, PDO::PARAM_STR);
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $query->bindValue(':image', $image, PDO::PARAM_STR);
        $query->bindValue(':user_id', $user_id, PDO::PARAM_STR);

        // Exécution de la requête
        $query->execute();

        // Redirection vers la page de blog avec un message de succès
        $_SESSION['message'] = "Produit ajouté avec succès !";
        exit();
    } else {
        // Redirection vers la page de blog avec un message d'erreur si des champs sont manquants
        $_SESSION['error'] = "Tous les champs doivent être remplis.";
        header('Location: blog.php');
        exit();
    }
}

require_once('close.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <style>


        .btn {
            --color2: #055634;
            --color1: grey;
            perspective: 1000px;
            padding: 1em 1em;
            background: linear-gradient(var(--color1), var(--color2));
            border: none;
            outline: none;
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #fff;
            text-shadow: 0 10px 10px #000;
            cursor: pointer;
            transform: rotateX(70deg) rotateZ(30deg);
            transform-style: preserve-3d;
            transition: transform 0.5s;
        }

        .btn::before {
            content: "";
            width: 100%;
            height: 15px;
            background-color: var(--color2);
            position: absolute;
            bottom: 0;
            right: 0;
            transform: rotateX(90deg);
            transform-origin: bottom;
        }

        .btn::after {
            content: "";
            width: 15px;
            height: 100%;
            background-color: var(--color1);
            position: absolute;
            top: 0;
            right: 0;
            transform: rotateY(-90deg);
            transform-origin: right;
        }

        .btn:hover {
            transform: rotateX(30deg) rotateZ(0);
        }

        button {
            border: none;
            outline: none;
            background-color: #055634;
            padding: 10px 20px;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            border-radius: 5px;
            transition: all ease 0.1s;
            box-shadow: 0px 5px 0px 0px #a29bfe;
        }

        button:active {
            transform: translateY(5px);
            box-shadow: 0px 0px 0px 0px #a29bfe;
        }
    </style>
</head>


<body class="bg-gray-100">
    <div class="container">
    <form method="post" class="max-w-md mx-auto my-8 p-6 bg-white rounded shadow-md" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="titre" class="block text-gray-700 text-sm font-bold mb-2">Titre</label>
                <input type="text" name="titre" id="titre"
                    class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <input type="text" name="description" id="description"
                    class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue">
            </div>
            <div class="mb-4">
                <label for="article" class="block text-gray-700 text-sm font-bold mb-2">Article</label>
                <textarea name="article" id="article"
                    class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue"
                    rows="6"></textarea>
            </div>
            <div class="mb-4">
                <label for="categorie" class="block text-gray-700 text-sm font-bold mb-2">Catégorie</label>
                <select name="categorie" id="categorie" class="w-full border p-2 rounded">
                    <?php
                    try {
                        $db = new PDO("mysql:host=localhost;dbname=infoclimat", "root", "");
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Récupération des catégories depuis la base de données
                        $query = $db->query("SELECT * FROM categorie;");
                        $categories = $query->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($categories as $category) {
                            $selected = ($category['id'] == $result['categorie_id']) ? 'selected' : '';
                            $idcat = $category['id'];
                            $idlab = $category['label'];

                            // Générer l'option pour chaque catégorie
                            ?>
                            <option <?= $selected ?> value="<?= $idcat ?>">
                                <?= $idlab ?>
                            </option>
                            <?php
                        }
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                    ?>
                </select>
            </div>
            <div class="mb-4 hidden">
                <label for="statut" class="block text-gray-700 text-sm font-bold mb-2">Statut</label>
                <input type="number" name="statut" id="statut" min="2" max="2" value="2" readonly
                    class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue">
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                <input type="file" name="image" id="image"
                    class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue">
            </div>
            <div class="flex flex-row">
                <button type="submit">Enregistrer</button>
                <button type="button" onclick="window.location.href='blog.php'">Retour</button>
            </div>
        </form>
    </div>
</body>

</body>

<?php
include('footer.php');
?>


</html>