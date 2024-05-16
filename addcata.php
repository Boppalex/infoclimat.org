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
        /* Vos styles CSS ici */
    </style>
</head>

<body class="bg-gray-100">
    <?php include 'header.php'; ?>

    <?php
    require_once('connect.php');

    if (!empty($_POST)) {
        if (
            isset($_POST['titre']) && !empty($_POST['titre'])
            && isset($_POST['description']) && !empty($_POST['description'])
            && isset($_POST['article']) && !empty($_POST['article'])
            && isset($_POST['statut']) && !empty($_POST['statut'])
        ) {
            $titre = strip_tags($_POST['titre']);
            $description = strip_tags($_POST['description']);
            $article = strip_tags($_POST['article']);
            $statut = strip_tags($_POST['statut']);
            $pays = isset($_POST['pays']) ? strip_tags($_POST['pays']) : null; // Vérification facultative si 'pays' est défini

            // Gestion de l'image
            $image = null;
            if (isset($_FILES['image'])) {
                $image = $_FILES['image']['name'];
                $image = file_get_contents($_FILES['image']['tmp_name']);
            }

            $sql = "INSERT INTO `infoswiper` (`titre`, `description`, `article`, `categorie`, `image`, `statut`,  `pays`) VALUES (:titre, :description, :article, 5 ,:image, :statut, :pays )";

            $query = $db->prepare($sql);

            $query->bindValue(':titre', $titre, PDO::PARAM_STR);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->bindValue(':article', $article, PDO::PARAM_STR);
            $query->bindValue(':statut', $statut, PDO::PARAM_STR);
            $query->bindValue(':image', $image, PDO::PARAM_STR);
            $query->bindValue(':pays', $pays, PDO::PARAM_STR);

            $query->execute();
            $_SESSION['message'] = "Produit ajouté avec succès !";
        }
    }

    require_once('close.php');
    ?>

    <div class="container">
        <form method="post" class="max-w-md mx-auto my-8 p-6 bg-white rounded shadow-md" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="titre" class="block text-gray-700 text-sm font-bold mb-2">Titre</label>
                <input type="text" name="titre" id="titre" class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <input type="text" name="description" id="description" class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue">
            </div>
            <div class="mb-4">
                <label for="article" class="block text-gray-700 text-sm font-bold mb-2">Article</label>
                <textarea name="article" id="article" class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue" rows="6"></textarea>
            </div>
            <div class="mb-4">
                <label for="statut" class="block text-gray-700 text-sm font-bold mb-2">Statut</label>
                <input type="number" name="statut" id="statut" min="1" max="2" class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue">
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                <input type="file" name="image" id="image" class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue">
            </div>
            <div class="mb-4">
                <label for="pays" class="block text-gray-700 text-sm font-bold mb-2">Pays</label>
                <input type="text" name="pays" id="pays" class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue">
            </div>
            <div class="flex flex-row gap-2">
                <button type="submit">Enregistrer</button>
                <button type="button" onclick="window.location.href='backend.php'">Retour</button>
            </div>
        </form>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>
