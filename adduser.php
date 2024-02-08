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
        header('Location: blog.php');
    }
}

require_once('close.php');
?>

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

        html,
        body{
            padding: 0;
            margin: 0;
            position: relative;
            transition: background 4s ease;
            /* Transition pour le changement de fond */
        }

        /* CSS */
        a.testa .hidden.sm\:inline-block {
            display: none;
        }

        a.testa:hover .hidden.sm\:inline-block {
            display: inline-block;
        }


        /* Ajout d'une classe pour le fond pendant l'easter egg */
        body.rainy {
            background: #333;
            /* Couleur du fond pendant l'easter egg */
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
        body {
            margin: 0;
            background-color: #f3f4f6;
        }

        footer {
            background-color: #055634;
            color: white;

        }

        header {
            background-image: url('Images/wave.png');
        }


        div.testclass {
            background-color: #fff;
            /* Fond gris clair */
        }

        body.rainy div.testclass {
            background-color: #ffff;
            color: #fff;
            /* Fond gris clair */
        }

        body.rainy div.intro {
            color: #fff;
            /* Fond gris clair */
        }



        div.card1 {
            background-color: #fff;
            /* Fond gris clair */
        }

        body.rainy div.card1 {
            background-color: #ffff;
            /* Fond gris clair */
        }

        body.rainy header {
            background-image: none;
        }

        body.rainy footer {

            background-color: #333;
            overflow: hidden;
            transition: background 4s ease;
            /* Fond gris clair */

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
                            <div class="superposition-simple "><a href="blog.php">
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
                <label for="categorie" class="block text-gray-700 text-sm font-bold mb-2">Catégorie</label>
                <select name="categorie" id="categorie"
                    class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue">
                    <?php
                    try {
                        $conn = new PDO("mysql:host=localhost;dbname=infoclimat", "root", "");
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Récupération des catégories depuis la base de données
                        $query = $conn->query("SELECT `id` FROM `categorie`");
                        $categories = $query->fetchAll(PDO::FETCH_COLUMN);

                        // Génération des options pour le champ select
                        foreach ($categories as $category) {
                            $selected = ($category == $result['categorie']) ? 'selected' : '';
                            echo "<option value=\"$category\" $selected>$category</option>";
                        }
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                    ?>
                </select>
            </div>
            <div class="mb-4 hidden">
                <label for="statut" class="block text-gray-700 text-sm font-bold mb-2">Statut</label>
                <input type="number" name="statut" id="statut" min="2" max="2" value="2" readonly
                    class="w-full px-3 py-2 border rounded shadow appearance-none focus:outline-none focus:shadow-outline-blue">
            </div>
            <div class="flex flex-row">
                <button type="submit">Enregistrer</button>
                <button type="button" onclick="window.location.href='blog.php'">Retour</button>
            </div>
        </form>
    </div>
</body>

</body>
<footer class="p-4 w-full fixed bottom-0 ">
    <p class="flex justify-center">@SIO2Groupe2</p>
    <p class="flex justify-center">By Adrien Cirade, Roman Bourguignon, Steven Thomassin, Alexandre Bopp, Samuel
        Azoulay, Hugo Moreaux</p>
</footer>

</html>