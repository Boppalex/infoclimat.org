

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
<?php
include 'header.php';
?>

<?php

require_once('connect.php');

// Vérifier si l'utilisateur est connecté

if (isset($_POST)) {
    if (
        isset($_POST['titre']) && !empty($_POST['titre'])
        && isset($_POST['description']) && !empty($_POST['description'])
        && isset($_POST['article']) && !empty($_POST['article'])
        && isset($_POST['categorie']) && !empty($_POST['categorie'])
        && isset($_POST['statut']) && !empty($_POST['statut'])
    ) {
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
        header('Location: backend.php');
    }
}

require_once('close.php');
?>

<body class="bg-gray-100">
    <div class="container">
        <form method="post" class="max-w-md mx-auto my-8 p-6 bg-white rounded shadow-md">
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

            <div class="mb-4">
                <label for="statut" class="block text-gray-700 text-sm font-bold mb-2">Statut</label>
                <input type="number" name="statut" id="statut" min="1" max="2"
                    class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue">
            </div>
            <div class="flex flex-row gap-2">
                <button type="submit">Enregistrer</button>
                <button type="button" onclick="window.location.href='backend.php'">Retour</button>
            </div>
        </form>
    </div>
</body>

<footer class="p-4 w-full ">
    <p class="flex justify-center">@SIO2Groupe2</p>
    <p class="flex justify-center">By Adrien Cirade, Roman Bourguignon, Steven Thomassin, Alexandre Bopp, Samuel
        Azoulay, Hugo Moreaux</p>
</footer>

</html>