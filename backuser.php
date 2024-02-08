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
$sql = 'SELECT * FROM `infocarte` WHERE statut = 2';

// Préparation de la requête
$query = $db->prepare($sql);

// Exécution de la requête
$query->execute();

// Récupération des résultats dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);


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
    $result1 = $query->fetch(PDO::FETCH_ASSOC);

    // Si la requête a retourné un résultat valide, mettez à jour la variable $is_admin
    if ($result !== false) {
        $is_admin = (int) $result1['isadmin']; // Convertit la valeur en entier
    }
}
?>


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
        button.btn {
            background-color: #055634;
            color: white;
        }

        header {
            background-image: url('Images/wave.png');
        }

        th.bgtabl {
            background-color: #055634;
        }

        /* CSS */
        a.testa .hidden.sm\:inline-block {
            display: none;
        }

        a.testa:hover .hidden.sm\:inline-block {
            display: inline-block;
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
    class="entete flex flex-col sm:flex-row justify-center items-center p-1 sm:p-8 md:p-16 lg:p-20 xl:p-24 bg-cover bg-center h-300 sm:h-200 md:h-250 lg:h-300 xl:h-500">
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
                <?php if ($logged_in && $is_admin != 1): ?>

                    <li class="nav-item">
                        <div class=" rounded-full w-full sm:w-20 h-20 text-center flex">
                            <div class="superposition-simple "><a href="backuser.php">
                                    <div class="texte-normal ">
                                        <div class="texte-original">Carte</div>
                                    </div>
                                    <div class="texte-hover "><img decoding="async" class="image-originale "
                                            src="Images/feuillemorte.png" />
                                        <div class="texte-original">Carte</div>
                                    </div>
                                </a></div>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <div class=" rounded-full w-full sm:w-20 h-20 text-center flex">
                        <div class="superposition-simple "><a href="apropos.php">
                                <div class="texte-normal ">
                                    <div class="texte-original">Nous</div>
                                </div>
                                <div class="texte-hover "><img decoding="async" class="image-originale "
                                        src="Images/glace.png" />
                                    <div class="texte-original">Nous</div>
                                </div>
                            </a></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Lien de connexion / déconnexion -->
    <a class="testa" href="<?php echo $logged_in ? 'logout.php' : 'login.php'; ?>"
        class="flex items-center mb-2 sm:mb-0 sm:mr-2">
        <img src="Images/logo.png" alt="logo" class="w-12 h-12 rounded-full ">
        <span class="hidden sm:inline-block ml-1 text-white rounded-full hover:inline-block">
            <?php if ($logged_in): ?>
                <?php echo $username; ?>
            <?php else: ?>
                Connexion
            <?php endif; ?>
        </span>
    </a>
</header>

<body class="bg-gray-100 ">
    <div class="container  p-4 ">
        <h1 class="text-3xl text-center mb-8">Bienvenue sur votre espace ,
            <?php echo $_SESSION["username"]; ?>!
        </h1>

        <table class="  border-collapse border border-gray-200">
            <thead>
                <tr>

                    <th id="titre"
                        class="bgtabl px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider" array_multisort()>
                        Titre <button onclick="sortTable('titre')">Trier</button>
                    </th>

                    <th class="bgtabl px-6 py-3  text-left text-xs font-medium text-white uppercase tracking-wider">
                        Description</th>
                    <th class="bgtabl px-6 py-3  text-left text-xs font-medium text-white uppercase tracking-wider">
                        Article</th>

                    <th id="categorie"
                        class="bgtabl px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Catégorie <button onclick="sortTable('categorie')">Trier</button>
                    </th>

                    <th class="bgtabl px-6 py-3  text-left text-xs font-medium text-white uppercase tracking-wider">
                        Bouton</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $carte): ?>
                    <tr class="bg-gray-100 hover:bg-gray-200">
                        <td class="p-4 ">
                        <?= substr($carte['titre'], 0, 255) . (strlen($carte['titre']) > 255 ? '...' : '') ?>
                        </td>
                        <td class="p-4 ">
                            <?= substr($carte['description'], 0, 255) . (strlen($carte['description']) > 255 ? '...' : '') ?>
                        </td>
                        <td class="p-4 ">
                            <?= substr($carte['article'], 0, 255) . (strlen($carte['article']) > 255 ? '...' : '') ?>

                        </td>
                        <td class="p-4 ">
                        <?= substr($carte['categorie'], 0, 255) . (strlen($carte['categorie']) > 255 ? '...' : '') ?>
                        </td>
                        <td>
                        <a href="edit.php?id=<?= $carte['id'] ?>"><button class="btn hover:shadow-md"><span>Modifier</span></button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</body>

<footer class="p-4 w-full fixed bottom-0 ">
    <p class="flex justify-center">@SIO2Groupe2</p>
    <p class="flex justify-center">By Adrien Cirade, Roman Bourguignon, Steven Thomassin, Alexandre Bopp, Samuel
        Azoulay, Hugo Moreaux</p>
</footer>
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

</html>