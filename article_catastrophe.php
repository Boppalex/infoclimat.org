<?php
include 'header.php';

// Connexion à la base de données
require_once "connect.php";

// Initialisation des variables
$article_title = '';
$article_description = '';
$article_pays = '';
$article_article = '';
$article_categorie = '';
$article_image = '';
$article_datecreation = '';

// Vérifier si l'ID de l'article est passé dans l'URL
if (isset($_GET['id'])) {
    // Récupérer l'ID de l'article depuis l'URL
    $article_id = $_GET['id'];

    // Requête SQL pour récupérer les informations de l'article depuis la base de données
    $sql = 'SELECT * FROM `infoswiper` WHERE id = :article_id';

    // Préparation de la requête
    $query = $db->prepare($sql);

    // Liaison du paramètre :article_id avec la valeur de l'ID de l'article
    $query->bindParam(':article_id', $article_id, PDO::PARAM_INT);

    // Exécution de la requête
    $query->execute();

    // Récupération des résultats dans un tableau associatif
    $article = $query->fetch(PDO::FETCH_ASSOC);
    $nom = $query->fetchColumn(); 

    // Vérifier si l'article existe
    if ($article) {
        // Récupérer les informations de l'article
        $article_title = $article['titre'];
        $article_description = $article['description'];
        $article_pays = $article['pays'];
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
$sql="SELECT nom
FROM utilisateur
INNER JOIN infocarte ON utilisateur.id = infocarte.creerpar
WHERE infocarte.id = :article_id;";
$query = $db->prepare($sql);
$query->bindParam(':article_id', $article_id, PDO::PARAM_INT);
$query->execute();
$nom = $query->fetchColumn(); // Récupérer le nom de l'utilisateur
?>
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

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

                <p class="text-lg mb-8 leading-relaxed">
                    <?php echo $article_pays; ?>
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
                            <?php echo $nom; ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2677.6248912325027!2d2.024501576823527!3d47.846859871354965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e51d8afbda55d5%3A0x3f7ab15696bf7746!2s473%20Rte%20d&#39;Orl%C3%A9ans%2C%2045640%20Sandillon!5e0!3m2!1sfr!2sfr!4v1707490827292!5m2!1sfr!2sfr"
                    style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    class="w-full h-72"></iframe>
            </div>

        </div>
    </div>

</body>
<?php

include 'footer.php';
?>

</html>