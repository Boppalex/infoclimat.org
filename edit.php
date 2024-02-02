<?php
require_once('connect.php');

if(isset($_POST)){
    if(isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['titre']) && !empty($_POST['titre'])
        && isset($_POST['description']) && !empty($_POST['description'])
        && isset($_POST['article']) && !empty($_POST['article'])
        && isset($_POST['categorie']) && !empty($_POST['categorie'])
        && isset($_POST['statut']) && !empty($_POST['statut'])){
        $id = strip_tags($_GET['id']);
        $titre = strip_tags($_POST['titre']);
        $description = strip_tags($_POST['description']);
        $article = strip_tags($_POST['article']);
        $categorie = strip_tags($_POST['categorie']);
        $statut = strip_tags($_POST['statut']);

        $sql = "UPDATE `infocarte` SET `titre`=:titre, `description`=:description, `article`=:article, `categorie`=:categorie, `statut`=:statut WHERE `id`=:id;";

        $query = $db->prepare($sql);

        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':description', $description, PDO::PARAM_STR);
        $query->bindValue(':article', $article, PDO::PARAM_STR);
        $query->bindValue(':categorie', $categorie, PDO::PARAM_STR);
        $query->bindValue(':statut', $statut, PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();

        header('Location: backend.php');
    }
    }

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    $sql = "SELECT * FROM `infocarte` WHERE `id`=:id;";

    $query = $db->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetch();

}

require_once('close.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        button {
 outline: none;
 cursor: pointer;
 border: none;
 padding: 0.9rem 2rem;
 margin: 0;
 font-family: inherit;
 font-size: inherit;
 position: relative;
 display: inline-block;
 letter-spacing: 0.05rem;
 font-weight: 700;
 font-size: 17px;
 border-radius: 500px;
 overflow: hidden;
 background: #66ff66;
 color: ghostwhite;
}

button span {
 position: relative;
 z-index: 10;
 transition: color 0.4s;
}

button:hover span {
 color: black;
}

button::before,
button::after {
 position: absolute;
 top: 0;
 left: 0;
 width: 100%;
 height: 100%;
 z-index: 0;
}

button::before {
 content: "";
 background: #000;
 width: 120%;
 left: -10%;
 transform: skew(30deg);
 transition: transform 0.4s cubic-bezier(0.3, 1, 0.8, 1);
}

button:hover::before {
 transform: translate3d(100%, 0, 0);
}

    </style>
</head>
<body>
    <h1>Modifier un produit</h1>
    <form method="post">
        <p>
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="<?= $result['titre'] ?>">
        </p>
        <p>
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10"><?= $result['description'] ?></textarea>
        </p>
        <p>
            <label for="article">Article</label>
            <input type="text" name="article" id="article" value="<?= $result['article'] ?>">
        </p>
        <p>
            <label for="categorie">Catégorie</label>
            <input type="text" name="categorie" id="categorie" value="<?= $result['categorie'] ?>">
        </p>
        <p>
            <label for="statut">Statut</label>
            <input type="number" name="statut" id="statut" value="<?= $result['statut'] ?>">
        </p>
        <p>
        <button><span>Enregistrer</span></button>
        </p>
        <input type="hidden" name="id" value="<?= $result['id'] ?>">
    </form>
    <button onclick="window.location.href = 'backend.php';"><span>Retour</span></button>
</body>
</html>