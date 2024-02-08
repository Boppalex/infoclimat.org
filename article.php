<?php

session_start();

// Connexion à la base de données
require_once "connect.php";

// Initialisation des variables
$article_title = '';
$article_description = '';
$article_article = '';
$article_categorie = '';
$article_image = '';
$article_datecreation = '';

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
// Vérifier si l'ID de l'article est passé dans l'URL
if (isset($_GET['id'])) {
    // Récupérer l'ID de l'article depuis l'URL
    $article_id = $_GET['id'];

    // Requête SQL pour récupérer les informations de l'article depuis la base de données
    $sql = 'SELECT * FROM `infocarte` WHERE id = :article_id';

    // Préparation de la requête
    $query = $db->prepare($sql);

    // Liaison du paramètre :article_id avec la valeur de l'ID de l'article
    $query->bindParam(':article_id', $article_id, PDO::PARAM_INT);

    // Exécution de la requête
    $query->execute();

    // Récupération des résultats dans un tableau associatif
    $article = $query->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'article existe
    if ($article) {
        // Récupérer les informations de l'article
        $article_title = $article['titre'];
        $article_description = $article['description'];
        $article_article = $article['article'];
        $article_categorie = $article['categorie'];
        $article_image = $article['image'];
        $article_datecreation = $article['datecreation']; // Ajout de la date de création de l'article
    } else {
        // Redirection vers une autre page si l'article n'est pas trouvé
        header("Location: passerelle.php");
        exit();
    }
} else {
    // Redirection vers une autre page si l'ID de l'article n'est pas passé dans l'URL
    header("Location: passerelle.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
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
                footer {
            background-color: #055634;
            color: white;
         }
        
         header {
            background-image: url('Images/wave.png');
        }
        body.rainy header {
            background-image: none;
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

<body class="bg-gray-100 text-gray-800 font-sans">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white shadow-md p-8 rounded-lg">
            <h1 class="text-3xl font-bold mb-4 text-center">
                <?php echo $article_title; ?>
            </h1>

            <div class="container h-72 overflow-hidden rounded-lg mb-8 border-2">
                <?php if (empty($article_image)): ?>
                    <!-- Afficher l'image par défaut si la colonne "image" est vide -->
                    <img src="Images/ImageClimat2.jpg" alt="Image par défaut" class="w-full object-cover">
                <?php else: ?>
                    <?php
                    // Encodage de l'image en base64
                    $imageData = base64_encode($article_image);

                    // Type de contenu de l'image (assurez-vous que cela correspond au type d'image dans votre base de données)
                    $imageType = "image/jpeg"; // Exemple pour le format JPEG, ajustez selon votre besoin
                    ?>
                    <!-- Affichage de l'image -->
                    <img src="data:<?php echo $imageType; ?>;base64,<?php echo $imageData; ?>"
                        alt="<?php echo $article_title; ?>" class="object-cover object-center h-full w-full">
                <?php endif; ?>
            </div>


            <div class="border-2 rounded-lg p-4">
                <p class="text-lg mb-8 leading-relaxed">
                    <?php echo $article_description; ?>
                </p>

                <p class="text-lg mb-8 leading-relaxed">
                    <?php echo $article_article; ?>
                </p>

                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-lg mb-4">Catégorie:
                            <?php echo $article_categorie; ?>
                        </p>
                        <p class="text-lg mb-4">Date de création:
                            <?php echo $article_datecreation; ?>
                        </p>
                    </div>
                    <div>
                        <p class="text-lg mb-4">Auteur:
                            à récupérer
                        </p>
                        <p class="text-lg mb-4">Source:
                            à récupérer
                        </p>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <footer class="p-4 w-full ">
    <p class="flex justify-center">@SIO2Groupe2</p>
    <p class="flex justify-center">By Adrien Cirade, Roman Bourguignon, Steven Thomassin, Alexandre Bopp, Samuel
        Azoulay, Hugo Moreaux</p>
</footer>
</body>

</html>