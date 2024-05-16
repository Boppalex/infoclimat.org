<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>CRUD admin</title>
    <style>
        thead {
            background-color: #055634;
            color: white;
        }

        button.btn {
            background-color: #055634;
            color: white;
        }

        th.bgtabl {
            background-color: #055634;
        }


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
    </style>
</head>
<?php
include 'header.php';
?>
<?php
require_once('connect.php');
// Requête SQL pour récupérer les données
$sql = 'SELECT DISTINCT infocarte.id, infocarte.titre, infocarte.description, infocarte.article, infocarte.statut, categorie.label as categorie
        FROM infocarte
        JOIN categorie ON infocarte.categorie = categorie.id
        Order by infocarte.id DESC'
        ;


// Préparation de la requête
$query = $db->prepare($sql);

// Exécution de la requête
$query->execute();

// Récupération des résultats dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$sql1 = 'SELECT DISTINCT infoswiper.id, infoswiper.titre, infoswiper.description, infoswiper.article, infoswiper.statut, infoswiper.pays , categorie.label as categorie
        FROM infoswiper
        JOIN categorie ON infoswiper.categorie = categorie.id
        Order by infoswiper.id DESC'
        ;


// Préparation de la requête
$query2 = $db->prepare($sql1);

// Exécution de la requête
$query2->execute();

// Récupération des résultats dans un tableau associatif
$result1 = $query2->fetchAll(PDO::FETCH_ASSOC);

?>

<body class="bg-gray-100 ">
    <div class="container">
        <h1 class="text-3xl" style="text-align: center; margin-top:50px;">Welcome,
            <?php echo $_SESSION["username"]; ?>!
        </h1>
        <a href="add.php" class="text-white mb-3">
            <button class="btn">Ajouter article
            </button>
        </a>
        <div class=" overflow-scroll" style="height: 250px;">
            <table style="">
                <thead>

                    <tr>
                        <th class="bgtabl px-6 py-3  text-left text-xs font-medium text-white uppercase tracking-wider">
                            ID</th>
                        <th id="titre"
                            class="bgtabl px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider"
                            array_multisort()>
                            Titre <button onclick="sortTable('titre')">Trier</button>
                        </th>

                        <th class="bgtabl px-6 py-3  text-left text-xs font-medium text-white uppercase tracking-wider">
                            Description</th>
                        <th class="bgtabl px-6 py-3  text-left text-xs font-medium text-white uppercase tracking-wider">
                            Article</th>

                        <th id="categorie"
                            class="bgtabl px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Catégorie
                        </th>
                        <th class="bgtabl px-6 py-3  text-left text-xs font-medium text-white uppercase tracking-wider">
                            Statut</th>
                        <th class="bgtabl px-6 py-3  text-left text-xs font-medium text-white uppercase tracking-wider">
                            Crud</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $carte) {
                        ?>
                        <tr>
                            <td class="p-4 bg-gray-700 border-2 text-white">
                                <?= $carte['id'] ?>
                            </td>
                            <td class="p-4 bg-gray-700 border-2">
                                <a class="text-black hover:text-black" href="article.php?id=<?= $carte['id'] ?>"><button
                                        class="w-full h-full border-2 rounded bg-white">
                                        <?= substr($carte['titre'], 0, 255) . (strlen($carte['titre']) > 255 ? '...' : '') ?>
                                    </button></a>
                            </td>
                            <td class="p-4 border-2">
                                <?= substr($carte['description'], 0, 255) . (strlen($carte['description']) > 255 ? '...' : '') ?>
                            </td>
                            <td class="p-4 border-2">
                                <?= substr($carte['article'], 0, 255) . (strlen($carte['article']) > 255 ? '...' : '') ?>
                            </td>
                            <td class="p-4 border-2">
                                <?= substr($carte['categorie'], 0, 255) . (strlen($carte['categorie']) > 255 ? '...' : '') ?>
                            </td>
                            <td class="p-4 border-2">
                                <?= $carte['statut'] ?>
                            </td>
                            <td class="p-4 border-2">
                                </br>
                                <a href="edit.php?id=<?= $carte['id'] ?>">Modifier</a>
                                <a href="delete.php?id=<?= $carte['id'] ?>">Supprimer</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <a href="addcata.php" class="text-white mb-3">
            <button class="btn">Ajouter catastrophe
            </button>
        </a>
        <div class=" overflow-scroll" style="height: 250px;">
            <table style="">
                <thead>

                    <tr>
                        <th class="bgtabl px-6 py-3  text-left text-xs font-medium text-white uppercase tracking-wider">
                            ID</th>
                        <th id="titre"
                            class="bgtabl px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider"
                            array_multisort()>
                            Titre <button onclick="sortTable('titre')">Trier</button>
                        </th>

                        <th class="bgtabl px-6 py-3  text-left text-xs font-medium text-white uppercase tracking-wider">
                            Description</th>
                        <th class="bgtabl px-6 py-3  text-left text-xs font-medium text-white uppercase tracking-wider">
                            Article</th>

                        <th id="categorie"
                            class="bgtabl px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Catégorie
                        </th>
                        <th class="bgtabl px-6 py-3  text-left text-xs font-medium text-white uppercase tracking-wider">
                            Statut</th>
                            <th class="bgtabl px-6 py-3  text-left text-xs font-medium text-white uppercase tracking-wider">
                            Pays</th>
                        <th class="bgtabl px-6 py-3  text-left text-xs font-medium text-white uppercase tracking-wider">
                            Crud</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result1 as $catas) {
                        ?>
                        <tr>
                            <td class="p-4 bg-gray-700 border-2 text-white">
                                <?= $catas['id'] ?>
                            </td>
                            <td class="p-4 bg-gray-700 border-2">
                                <a class="text-black hover:text-black" href="article.php?id=<?= $catas['id'] ?>"><button
                                        class="w-full h-full border-2 rounded bg-white">
                                        <?= substr($catas['titre'], 0, 255) . (strlen($catas['titre']) > 255 ? '...' : '') ?>
                                    </button></a>
                            </td>
                            <td class="p-4 border-2">
                                <?= substr($catas['description'], 0, 255) . (strlen($catas['description']) > 255 ? '...' : '') ?>
                            </td>
                            <td class="p-4 border-2">
                                <?= substr($catas['article'], 0, 255) . (strlen($catas['article']) > 255 ? '...' : '') ?>
                            </td>
                            <td class="p-4 border-2">
                                <?= substr($catas['categorie'], 0, 255) . (strlen($catas['categorie']) > 255 ? '...' : '') ?>
                            </td>
                            <td class="p-4 border-2">
                                <?= $catas['statut'] ?>
                            </td>
                            <td class="p-4 border-2">
                                <?= $catas['statut'] ?>
                            </td>
                            <td class="p-4 border-2">
                                </br>
                                <a href="editcata.php?id=<?= $catas['id'] ?>">Modifier</a>
                                <a href="deletecata.php?id=<?= $catas['id'] ?>">Supprimer</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
    

</body>
<div class="fixed bottom-0 w-full">
    <?php
    include 'footer.php';
    ?>
</div>

</html>