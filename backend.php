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
$sql = 'SELECT infocarte.*, categorie.label as categorie FROM infocarte, categorie WHERE infocarte.categorie = categorie.id' ;

// Préparation de la requête
$query = $db->prepare($sql);

// Exécution de la requête
$query->execute();

// Récupération des résultats dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<body class="bg-gray-100 ">
    <div class="container">
        <h1 class="text-3xl" style="text-align: center; margin-top:50px;">Welcome,
            <?php echo $_SESSION["username"]; ?>!
        </h1>
        <div class="container mt-4 mb-4">
            <form action="" method="GET" class="form-inline justify-content-center">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Rechercher par titre" name="search">
                </div>
                <button type="submit" class="ml-3">Rechercher</button>
            </form>
        </div>
        <table style="border-collapse: separate; border-spacing: 10px;">
            <thead>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Article</th>
                <th>Catégorie</th>
                <th>Statut</th>
            </thead>
            <tbody>
                <?php
                foreach ($result as $carte) {
                    ?>
                    <tr>
                        <td>
                            <?= $carte['id'] ?>
                        </td>
                        <td>
                            <?= $carte['titre'] ?>
                        </td>
                        <td>
                            <?= $carte['description'] ?>
                        </td>
                        <td>
                            <?= $carte['article'] ?>
                        </td>
                        <td>
                            <?= $carte['categorie'] ?>
                        </td>
                        <td>
                            <?= $carte['statut'] ?>
                        </td>
                        <td>
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
        <a href="add.php" class="text-white">
            <button class="btn">Ajouter
            </button>
        </a>

    </div>
   
</body>
 <?php
include 'footer.php';
?>
</html>