<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post">
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre">
    <label for="description">Description</label>
    <input type="text" name="description" id="description">
    <label for="article">Article</label>
    <input type="text" name="article" id="article">
    <label for="categorie">Catégorie</label>
    <input type="number" name="categorie" id="categorie">
    <label for="statut">Statut</label>
    <input type="number" name="statut" id="statut">
    <button>Enregistrer</button>
</form>
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
            header('Location: index.php');
        }
}

require_once('close.php');