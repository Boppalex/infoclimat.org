<?php
session_start();

require_once "connect.php";

// Vérifiez si l'utilisateur est connecté
$logged_in = isset($_SESSION['username']);

// Si l'utilisateur est connecté, récupérez le nom d'utilisateur
$username = '';
$is_admin = false; // Par défaut, l'utilisateur n'est pas un administrateur
if ($logged_in) {
    // Supposons que vous stockiez le nom d'utilisateur dans une variable de session appelée 'username'
    $username = $_SESSION['username'];

    // Préparation de la requête SQL pour récupérer isadmin de la base de données
    $sql = "SELECT isadmin FROM utilisateur WHERE nom = :username";

    // Préparation de la requête
    $query = $db->prepare($sql);

    // Exécution de la requête
    $query->execute([':username' => $username]);

    // Récupération des résultats
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Si la requête a retourné un résultat valide, mettez à jour la variable $is_admin
    if ($result !== false) {
        $is_admin = (int) $result['isadmin']; // Convertit la valeur en entier
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <style>
        header {
            background-image: url('Images/wave.png');
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

        .btncat {
            background-color: #055634;
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
                <?php if ($logged_in && $is_admin === 1): ?>

                    <li class="nav-item">
                        <div class=" rounded-full w-full sm:w-20 h-20 text-center flex">
                            <div class="superposition-simple "><a href="backend.php">
                                    <div class="texte-normal ">
                                        <div class="texte-original">Back</div>
                                    </div>
                                    <div class="texte-hover "><img decoding="async" class="image-originale "
                                            src="Images/feuillemorte.png" />
                                        <div class="texte-original">Back</div>
                                    </div>
                                </a></div>
                        </div>
                    </li>
                <?php endif; ?>
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

<body class="bg-gray-100">
    <div>

    </div>
    <?php
    // Connexion à la base de données
    $mysqli = new mysqli("localhost", "root", "", "infoclimat");

    // Vérification de la connexion
    if ($mysqli->connect_error) {
        die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
    }

    // Format
    $mysqli->set_charset("utf8");

    // Initialiser la variable de catégorie
    $categorie = '';

    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer la catégorie sélectionnée (si elle existe)
        $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
    }

    // Requête pour récupérer les informations de la table infocarte et infoswiper avec filtrage par catégorie
    $query = "SELECT id, titre, description, article, categorie, statut, image 
    FROM (
        SELECT id, titre, description, article, categorie, statut, image FROM infocarte 
        UNION ALL 
        SELECT id, titre, description, article, categorie, statut, image FROM infoswiper
    ) AS combined_tables";

    // Ajouter le filtre de catégorie si une catégorie est sélectionnée
    if (!empty($categorie)) {
    $query .= " WHERE categorie = '" . $mysqli->real_escape_string($categorie) . "'";
    }

// Exécuter la requête
$result = $mysqli->query($query);

    // Vérification s'il y a des résultats
    if ($result->num_rows > 0) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">

        <body class="bg-gray-100 pt-8">

            <div class="blog container pb-12 pt-12">
                <div class="text text-3xl font-bold mb-8 ">
                    <h1>Notre Blog :</h1>
                </div>

                <form method="post" class="mb-4 flex items-center justify-center">
                <label for="categorie" class="mr-2">Filtrer par catégorie :</label>  
        <select name="categorie" id="categorie" class="border rounded p-1 mr-2" style="margin-top: -3px;">
            <option value="">Toutes les catégories</option>
            
            <?php
            // Requête pour récupérer les libellés des catégories
            $categoriesQuery = "SELECT id, label FROM categorie";
            $categoriesResult = $mysqli->query($categoriesQuery);

            while ($categorieRow = $categoriesResult->fetch_assoc()) {
                // Vérifier si cette catégorie est celle sélectionnée
                $selected = ($categorie === $categorieRow['id']) ? 'selected' : '';
                echo '<option value="' . $categorieRow['id'] . '" ' . $selected . '>' . $categorieRow['label'] . '</option>';
            }
            ?>
        </select>
    <button type="submit" class="btncat text-white px-2 py-1 rounded" style="margin-top: -3px;">Filtrer</button>
</form>


                <div
                    class="grille grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 xl:grid-rows-2  gap-8">
                    <?php

                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="flex flex-col sm:flex-row col-span-1 row-span-1 sm:hover:shadow-lg rounded-3xl">
                            <div class="card1 border bg-white w-96 h-full rounded-3xl shadow-lg text-black bg-green-600">
                                <div class="Photo flex justify-center">
                                    <?php
                                    if (empty($row['image'])) {
                                        // Afficher l'image par défaut si la colonne "image" est vide
                                        echo '<img src="Images/ImageClimat.jpg" alt="Image par défaut" class="w-full h-44 rounded-t-3xl object-cover">';
                                    } else {
                                        // Encodage de l'image en base64 si la colonne "image" n'est pas vide
                                        $imageData = base64_encode($row['image']);
                                        $imageType = "image/jpeg"; // Assurez-vous que le type correspond à votre base de données
                                        // Afficher l'image depuis la base de données
                                        echo '<img src="data:' . $imageType . ';base64,' . $imageData . '" alt="image' . $row['id'] . '" class="w-full h-44 rounded-t-3xl object-cover">';
                                    }
                                    ?>
                                </div>

                                <div class="infocard pl-10 pt-4 pr-10">
                                    <div class="flex flex-row">
                                        <?php echo $row['description']; ?>
                                    </div>
                                </div>

                                <div class="boutonvalidation p-2 justify-end flex">
                                    <div class="boutonvalidation p-2 justify-end flex">
                                        <a href="article.php?id=<?php echo $row['id']; ?>"
                                            class="bg-white px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
                                            <span class="text-black text-sm">En savoir plus</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                
            </div>
            <div class= "justify-center flex pb-8">
<button type="submit" class="btncat text-white px-2 py-1 rounded ml-2 centered-button" onclick="window.location.href = 'adduser.php';">Créer un article</button>
            </div>


        <?php
    } else {
        echo "Aucun résultat trouvé dans la base de données.";
    }

    // Fermer la connexion à la base de données
    $mysqli->close();
    ?>

</body>
<footer class=" p-4  w-full">
    <p class="flex justify-center">@SIO2Groupe2</p>
    <p class="flex justify-center">By Adrien Cirade, Roman Bourguignon, Steven Thomassin, Alexandre Bopp, Samuel
        Azoulay, Hugo Moreaux</p>
</footer>

</html>