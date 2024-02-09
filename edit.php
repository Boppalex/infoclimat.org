

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        button.btn {
            background-color: #055634;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        a.btn {
            text-decoration: none;
            color: white;
            background-color: #055634;
        }

    </style>
</head>
<?php
include 'header.php';
?>
<?php

require_once('connect.php');


if (isset($_POST)) {
    if (
        isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['titre']) && !empty($_POST['titre'])
        && isset($_POST['description']) && !empty($_POST['description'])
        && isset($_POST['article']) && !empty($_POST['article'])
        && isset($_POST['categorie']) && !empty($_POST['categorie'])
        && isset($_POST['statut']) && !empty($_POST['statut'])
    ) {

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


    }
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = strip_tags($_GET['id']);
    $sql = "SELECT infocarte.*, categorie.label as categorie_label, categorie.id as categorie_id  FROM infocarte JOIN categorie ON infocarte.categorie = categorie.id WHERE infocarte.id=:id;";
   

    $query = $db->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetch();
}

require_once('close.php');
?>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Modifier un produit</h1>
        <form method="post">
            <div class="mb-4">
                <label for="titre" class="block text-sm font-semibold">Titre</label>
                <input type="text" name="titre" id="titre" value="<?= $result['titre'] ?>"
                    class="w-full border p-2 rounded">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-semibold">Description</label>
                <textarea name="description" id="description" cols="30" rows="10"
                    class="w-full border p-2 rounded"><?= $result['description'] ?></textarea>
            </div>
            <div class="mb-4">
                <label for="article" class="block text-sm font-semibold">Article</label>
                <input type="text" name="article" id="article" value="<?= $result['article'] ?>"
                    class="w-full border p-2 rounded">
            </div>
            <div class="mb-4">
                <label for="categorie" class="block text-sm font-semibold">Catégorie</label>
                <select name="categorie" id="categorie" class="w-full border p-2 rounded">
                    <?php
                    try {
                        $db = new PDO("mysql:host=localhost;dbname=infoclimat", "root", "");
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Récupération des catégories depuis la base de données
                        $query = $db->query("SELECT * FROM categorie;");
                        $categories = $query->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($categories as $category) {
                            $selected = ($category['id'] == $result['categorie']) ? 'selected' : '';
                            $idcat = $category['id'];
                            $idlab = $category['label'];

                            // Générer l'option pour chaque catégorie
                            ?>
                                <option <?= $idcat === $result["categorie_id"] ? "selected" : "" ?> value="<?= $idcat ?>" $selected><?= $idlab ?></option>
                            <?php
                        }
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                    ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="statut" class="block text-sm font-semibold">Statut</label>
                <input type="number" name="statut" id="statut" value="<?= $result['statut'] ?>"
                    class="w-full border p-2 rounded">
            </div>
            <div class="mb-4 flex flex-col md:flex-row gap-2">

                <?php if ($logged_in && $is_admin === 1) { ?>
                    <button type="submit" class="btn w-full" onclick="window.location.href = 'backend.php';">
                        Enregistrer
                    </button>
                <?php } ?>
                <?php if ($logged_in && $is_admin != 1) { ?>

                    <button type="submit " class="btn w-full" onclick="window.location.href = 'backuser.php';">
                        Enregistrer
                    </button>


                <?php } ?>

                <?php if ($logged_in && $is_admin === 1) { ?>
                    <a href="backend.php" class="btn w-full text-center p-2 rounded">
                        <button type="button">
                            Retour
                        </button>
                    </a>
                <?php } ?>
                <?php if ($logged_in && $is_admin != 1) { ?>
                    <a href="backuser.php" class="btn w-full text-center p-2 rounded">
                        <button type="button">
                            Retour
                        </button>
                    </a>
                <?php } ?>
            </div>
            <div class="mx-auto">
                <?php
                if (!empty($_POST)) {
                    echo "<p class='font-bold text-green-700 text-2xl'>Vous avez modifié un article.</p>";
                }
                ?>
            </div>

            <input type="hidden" name="id" value="<?= $result['id'] ?>">
        </form>
    </div>
</body>

<?php
include 'footer.php';
?>

</html>
