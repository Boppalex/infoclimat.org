<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["username"])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: login.php");
    exit();
}

require_once('connect.php');
// Requête SQL pour récupérer les données
$sql = 'SELECT * FROM `infocarte`';

// Préparation de la requête
$query = $db->prepare($sql);

// Exécution de la requête
$query->execute();

// Récupération des résultats dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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

<body class="bg-gray-100">
    <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>

    <table>
        <thead>
            <th>ID</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Article</th>
            <th>Statut</th>

        </thead>
        <tbody>
            <?php
            foreach ($result as $carte) {
            ?>
                <tr>
                    <td><?= $carte['id'] ?></td>
                    <td><?= $carte['titre'] ?></td>
                    <td><?= $carte['description'] ?></td>
                    <td><?= $carte['article'] ?></td>
                    <td><?= $carte['statut'] ?></td>
                    <td>
                    </br> 
                        <a href="details.php?id=<?= $carte['id'] ?>">Voir</a>
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

    
    <button class="btn"><a href="add.php">Ajouter</a></button>


    <footer class="bg-green-600 p-4 w-full fixed bottom-0">
        <p class="flex justify-center">@SIO2Groupe2</p>
        <p class="flex justify-center">By Adrien Cirade, Roman Bourguignon, Steven Thomassin, Alexandre Bopp, Samuel Azoulay, Hugo Moreaux</p>
    </footer>
</body>

</html>
