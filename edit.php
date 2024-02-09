<?php
session_start();

require_once('connect.php');

// Vérifiez si l'utilisateur est connecté
$logged_in = isset($_SESSION['username']);

// Si l'utilisateur est connecté, récupérez le nom d'utilisateur
$username = '';
$is_admin = false; // Par défaut, l'utilisateur n'est pas un administrateur
if ($logged_in) {
    // Supposons que vous stockiez le nom d'utilisateur dans une variable de session appelée 'username'
    $username = $_SESSION['username'];

    // Préparation de la requête SQL pour récupérer isadmin de la base de données
    $sql1 = "SELECT isadmin FROM utilisateur WHERE nom = :username";

    // Préparation de la requête
    $query = $db->prepare($sql1);

    // Exécution de la requête
    $query->execute([':username' => $username]);

    // Récupération des résultats
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Si la requête a retourné un résultat valide, mettez à jour la variable $is_admin
    if ($result !== false) {
        $is_admin = (int) $result['isadmin']; // Convertit la valeur en entier
    }
}

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

        footer {
            background-color: #055634;
            color: white;
        }

        .superposition-simple {
            position: relative;
            width: 100%;
        }

        .superposition-simple .image-originale {
            display: block;
            width: 100%;
            height: auto;
        }

        .superposition-simple .texte-original {
            color: #fff;
            font-size: 20px;
            line-height: 1.5em;
            text-shadow: 2px 2px 2px #000;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
        }

        .superposition-simple .texte-hover {
            position: absolute;
            top: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .5s ease;
        }

        .superposition-simple:hover .texte-normal {
            opacity: 0;
        }

        .superposition-simple:hover .texte-hover {
            opacity: 1;
        }

        .superposition-simple .texte-normal {
            transition: .5s ease;
        }
    </style>
</head>
<header
    class="entete flex flex-col sm:flex-row justify-center items-center p-1 sm:p-8 md:p-16 lg:p-20 xl:p-24 bg-cover bg-center h-300 sm:h-200 md:h-250 lg:h-300 xl:h-500"
    style="background-image: url('Images/wave.png');">
    <a href="accueil.php" class="mb-2 sm:mb-0 sm:mr-2">
        <img src="images/terre1.jpg" alt="logo" class="w-32 h-32">
    </a>

    <!-- Menu burger Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <div class=" rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                        <div class="superposition-simple  "><a href="accueil.php">
                                <div class="texte-normal ">
                                    <div class="texte-original ">Accueil</div>
                                </div>
                                <div class="texte-hover "><img decoding="async" class="image-originale "
                                        src="Images/feuille.png" />
                                    <div class="texte-original">Accueil</div>
                                </div>
                            </a></div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class=" rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                        <div class="superposition-simple "><a href="blog.php">
                                <div class="texte-normal ">
                                    <div class="texte-original">Blog</div>
                                </div>
                                <div class="texte-hover "><img decoding="async" class="image-originale "
                                        src="Images/nuage.png" />
                                    <div class="texte-original">Blog</div>
                                </div>
                            </a></div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class=" rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                        <div class="superposition-simple "><a href="quizz.php">
                                <div class="texte-normal ">
                                    <div class="texte-original">Quizz</div>
                                </div>
                                <div class="texte-hover "><img decoding="async" class="image-originale "
                                        src="Images/soleil.png" />
                                    <div class="texte-original">Quizz</div>
                                </div>
                            </a></div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class=" rounded-full w-full sm:w-20 h-20 text-center flex">
                        <div class="superposition-simple "><a href="apropos.php">
                                <div class="texte-normal ">
                                    <div class="texte-original">À propos</div>
                                </div>
                                <div class="texte-hover "><img decoding="async" class="image-originale "
                                        src="Images/glace.png" />
                                    <div class="texte-original">À propos</div>
                                </div>
                            </a></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

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
                <input type="text" name="categorie" id="categorie" value="<?= $result['categorie'] ?>"
                    class="w-full border p-2 rounded">
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
                    <?php
                    echo "Vous avez modifier un article";
                    ?>
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

<footer class="p-4 w-full">
    <p class="flex justify-center">@SIO2Groupe2</p>
    <p class="flex justify-center">By Adrien Cirade, Roman Bourguignon, Steven Thomassin, Alexandre Bopp, Samuel
        Azoulay, Hugo Moreaux</p>
</footer>

</html>