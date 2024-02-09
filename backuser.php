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
    <script>
        function sortTable(columnName) {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.querySelector('table   ');
            switching = true;
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("td")[getIndex(columnName)].textContent;
                    y = rows[i + 1].getElementsByTagName("td")[getIndex(columnName)].textContent;
                    if (columnName === 'titre') {
                        shouldSwitch = x.toLowerCase() > y.toLowerCase();
                    } else {
                        shouldSwitch = Number(x) > Number(y);
                    }
                    if (shouldSwitch) {
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                        break;
                    }
                }
            }
        }

        function getIndex(columnName) {
            var headers = document.querySelectorAll('th');
            for (var i = 0; i < headers.length; i++) {
                if (headers[i].id === columnName) {
                    return i;
                }
            }
            return -1;
        }
    </script>
    <style>
        button.btn {
            background-color: #055634;
            color: white;
        }

        th.bgtabl {
            background-color: #055634;
        }

        .btncat {
            background-color: #055634;
        }
    </style>
</head>
<?php
include 'header.php';
?>
<?php


require_once('connect.php');

// Récupérer l'ID de l'utilisateur connecté
$user_id = $_SESSION["user_id"];

// Requête SQL pour récupérer les données de l'utilisateur connecté
$sql = 'SELECT infocarte.*, categorie.label as categorie FROM infocarte, categorie, utilisateur  WHERE infocarte.categorie = categorie.id AND infocarte.creerpar = utilisateur.id AND utilisateur.id = :user_id';

// Préparation de la requête
$query = $db->prepare($sql);

// Exécution de la requête en liant la valeur de :user_id
$query->execute([':user_id' => $user_id]);

// Récupération des résultats dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<body class="bg-gray-100 ">
    <div class="container  p-4 ">
        <h1 class="text-3xl text-center mb-8">Bienvenue sur votre espace ,
            <?php echo $_SESSION["username"]; ?>!
        </h1>
        
        <div class=" overflow-scroll" style="height: 450px;">
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr>

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
                            Modification</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $carte): ?>
                        <a href="article.php?id=<?= $carte['id'] ?>">
                            <tr class="bg-gray-100 hover:bg-gray-200">
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
                                <td class="border-2 p-4">
                                    <a href="edit.php?id=<?= $carte['id'] ?>"><button
                                            class="btn hover:shadow-md"><span>Modifier</span></button></a>
                                </td>
                            </tr>
                        </a>
                    <?php endforeach; ?>

                </tbody>

            </table>
        </div>
        <div class="flex justify-center p-4">
            <button type="submit" class="btncat text-white px-2 py-1 rounded ml-2 centered-button"
                onclick="window.location.href = 'adduser.php';">Créer un article</button>
        </div>

    </div>
</body>

<div class="fixed bottom-0 w-full">
    <?php
    include 'footer.php';
    ?>
</div>



</html>