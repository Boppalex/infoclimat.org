<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <form method="post" class="max-w-md mx-auto my-8 p-6 bg-white rounded shadow-md">
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
            <input type="text" name="article" id="article" class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue">
        </div>
        <div class="mb-4">
            <label for="categorie" class="block text-gray-700 text-sm font-bold mb-2">Catégorie</label>
            <input type="text" name="categorie" id="categorie" class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue">
        </div>
        <div class="mb-4">
            <label for="statut" class="block text-gray-700 text-sm font-bold mb-2">Statut</label>
            <input type="number" name="statut" id="statut" class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue">
        </div>
        <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline-green">Enregistrer</button>
    </form>

    <a href="backend.php" class="block mx-auto mt-4 bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline-green fixed bottom-0 left-0 right-0">Retour</a>
</body>
</html>

<?php
require_once('connect.php');

if(isset($_POST)){
    if(isset($_POST['titre']) && !empty($_POST['titre'])
        && isset($_POST['description']) && !empty($_POST['description'])
        && isset($_POST['article']) && !empty($_POST['article'])
        && isset($_POST['categorie']) && !empty($_POST['categorie'])
        && isset($_POST['statut']) && !empty($_POST['statut'])){
            $titre = strip_tags($_POST['titre']);
            $description = strip_tags($_POST['description']);
            $article = strip_tags($_POST['article']);
            $categorie = strip_tags($_POST['categorie']);
            $statut = strip_tags($_POST['statut']);

            $sql = "INSERT INTO `infocarte` (`titre`, `description`, `article`, `categorie`, `statut`) VALUES (:titre, :description, :article, :categorie, :statut)";


            $query = $db->prepare($sql);

            $query->bindValue(':titre', $titre, PDO::PARAM_STR);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->bindValue(':article', $article, PDO::PARAM_STR);
            $query->bindValue(':categorie', $categorie, PDO::PARAM_STR);
            $query->bindValue(':statut', $statut, PDO::PARAM_STR);

            $query->execute();
            $_SESSION['message'] = "Produit ajouté avec succès !";
            header('Location: add.php');
        }
}

require_once('close.php');
?>
