<?php
// Connexion à la base de données
require_once "connect.php";

// Initialisation des variables
$article_title = '';
$article_description = '';
$article_article = '';
$article_categorie = '';
$article_image = '';
$article_datecreation = '';

// Vérifier si l'ID de l'article est passé dans l'URL
if (isset($_GET['id'])) {
    // Récupérer l'ID de l'article depuis l'URL
    $article_id = $_GET['id'];

    // Requête SQL pour récupérer les informations de l'article depuis la base de données
    $sql = "SELECT infocarte.*, categorie.label as categorie_label, categorie.id as categorie_id  FROM infocarte JOIN categorie ON infocarte.categorie = categorie.id WHERE infocarte.id=:id;";
    // Préparation de la requête
    $query = $db->prepare($sql);

    // Liaison du paramètre :article_id avec la valeur de l'ID de l'article
    $query->bindParam(':id', $article_id, PDO::PARAM_INT);

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
        $article_categorie = $article['categorie_label'];
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



</head>
<?php
include 'header.php';
?>

<body class="bg-gray-100 text-gray-800 font-sans">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white shadow-md p-8 rounded-lg">
            <h1 class="text-3xl font-bold mb-4 text-center">
                <?php echo $article_title; ?>
            </h1>

            <div class="container h-72 overflow-hidden rounded-lg mb-8 border-2">
                <?php if (empty($article_image)): ?>
                    <!-- Afficher l'image par défaut si la colonne "image" est vide -->
                    <img src="Images/ImageClimat2.jpg" alt="Image par défaut" class="w-full object-fit">
                <?php else: ?>
                    <?php
                    // Encodage de l'image en base64
                    $imageData = base64_encode($article_image);

                    // Type de contenu de l'image (assurez-vous que cela correspond au type d'image dans votre base de données)
                    $imageType = "image/jpeg"; // Exemple pour le format JPEG, ajustez selon votre besoin
                    ?>
                    <!-- Affichage de l'image -->
                    <img src="data:<?php echo $imageType; ?>;base64,<?php echo $imageData; ?>"
                        alt="<?php echo $article_title; ?>" class="object-fit object-center h-full w-full">
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
                            <?php echo $nom; ?>
                        </p>
                    </div>
                </div>
            </div>

            <?php if ($logged_in): ?>
                <div class="container mx-auto ">

                    <h2 class="text-xl font-semibold mb-2">Ajouter un commentaire</h2>
                    <form id="commentForm">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Votre nom</label>
                            <?php

                            // Si l'utilisateur est connecté, remplissez automatiquement le champ "Nom" avec le nom d'utilisateur
                            echo '<input id="name" value="' . $username . '" class="mt-1 w-full border p-2 rounded-md focus:outline-none focus:border-blue-500" disabled>';

                            ?>
                        </div>
                        <div class="mb-4">
                            <label for="comment" class="block text-gray-700">Votre commentaire</label>
                            <textarea id="comment" placeholder="Votre commentaire" required
                                class="mt-1 px-4 py-2 w-full border rounded-md focus:outline-none focus:border-blue-500"></textarea>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-2">
                            <button type="submit"
                                class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">Envoyer</button>

                            <button id="toggleButton"
                                class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">Trier</button>

                        </div>
                    </form>


                    <div id="comments" class="mb-4 pt-8 flex flex-col">
                        <!-- Les commentaires seront affichés ici -->
                    </div>
                </div>
            <?php endif; ?>
            <script>
                // Déclaration de la variable savedComments en dehors de la fonction DOMContentLoaded
                var savedComments = [];

                document.addEventListener('DOMContentLoaded', function () {
                    // Récupérer les commentaires sauvegardés dans le stockage local lors du chargement de la page
                    var articleId = <?php echo $article_id; ?>;
                    var articleCommentsKey = 'comments_' + articleId;
                    savedComments = JSON.parse(localStorage.getItem(articleCommentsKey)) || [];
                    var commentsContainer = document.getElementById('comments');

                    // Afficher les commentaires sauvegardés
                    savedComments.forEach(function (commentData) {
                        var commentElement = createCommentElement(commentData.name, commentData.comment);
                        commentsContainer.appendChild(commentElement);
                    });

                    // Ajouter un gestionnaire d'événements au formulaire de commentaire
                    document.getElementById('commentForm').addEventListener('submit', function (event) {
                        event.preventDefault(); // Empêcher le formulaire de se soumettre normalement

                        // Récupérer les valeurs du formulaire
                        var name = document.getElementById('name').value;
                        var comment = document.getElementById('comment').value;

                        // Créer un élément de commentaire
                        var commentElement = createCommentElement(name, comment);

                        // Ajouter le commentaire à la section de commentaires
                        commentsContainer.appendChild(commentElement);

                        // Sauvegarder le commentaire dans le stockage local avec l'ID de l'article
                        savedComments.push({ name: name, comment: comment });
                        localStorage.setItem(articleCommentsKey, JSON.stringify(savedComments));

                        // Réinitialiser le formulaire
                        document.getElementById('name').value = '';
                        document.getElementById('comment').value = '';
                    });

                    // Ajouter un gestionnaire d'événements pour le bouton de basculement
                    document.getElementById('toggleButton').addEventListener('click', function () {
                        commentsContainer.classList.toggle('flex-col');
                        commentsContainer.classList.toggle('flex-col-reverse');
                    });
                });

                function createCommentElement(name, comment) {
                    var commentContainer = document.createElement('div');
                    commentContainer.classList.add('max-w-70', 'relative'); // Ajout de relative pour positionner le bouton de suppression

                    var authorElement = document.createElement('div');
                    authorElement.textContent = name;
                    authorElement.classList.add('comment-author', 'font-bold');
                    commentContainer.appendChild(authorElement);

                    var commentContent = document.createElement('div');
                    commentContent.textContent = comment;
                    commentContent.classList.add('comment-content', 'bg-white', 'rounded-2xl', 'p-2', 'overflow-auto', 'border', 'border-gray-300', 'inline-block');
                    commentContainer.appendChild(commentContent);



                    <?php if ($logged_in && $is_admin === 1): ?>
                        // Boutons d'action pour l'administrateur
                        var actionButtons = document.createElement('div');
                        actionButtons.classList.add('absolute', 'top-2', 'right-2');

                        // Bouton de modification du commentaire
                        var editButton = document.createElement('button');
                        editButton.textContent = 'Modifier';
                        editButton.classList.add('px-2', 'py-1', 'mr-2', 'bg-blue-600', 'text-white', 'rounded-md', 'text-xs', 'hover:bg-blue-700', 'focus:outline-none');
                        editButton.addEventListener('click', function () {
                            // Remplir le formulaire de modification avec les données existantes
                            document.getElementById('name').value = name;
                            document.getElementById('comment').value = comment;
                        });
                        actionButtons.appendChild(editButton);

                        // Bouton de suppression du commentaire
                        var deleteButton = document.createElement('button');
                        deleteButton.textContent = 'Supprimer';
                        deleteButton.classList.add('px-2', 'py-1', 'bg-red-600', 'text-white', 'rounded-md', 'text-xs', 'hover:bg-red-700', 'focus:outline-none');
                        deleteButton.addEventListener('click', function () {
                            commentContainer.remove(); // Supprimer le commentaire du DOM
                            // Supprimer le commentaire du localStorage en recherchant l'index du commentaire dans savedComments
                            var articleId = <?php echo $article_id; ?>;
                            var index = savedComments.findIndex(function (item) {
                                return item.name === name && item.comment === comment;
                            });
                            if (index !== -1) {
                                savedComments.splice(index, 1);
                                localStorage.setItem('comments_' + articleId, JSON.stringify(savedComments));
                            }
                        });
                        actionButtons.appendChild(deleteButton);

                        commentContainer.appendChild(actionButtons);
                    <?php endif; ?>
                    return commentContainer;
                }
            </script>

        </div>

    </div>

</body>
<?php
include 'footer.php';
?>

</html>