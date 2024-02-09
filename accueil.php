<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple Tailwind CSS</title>
    <!-- Utilisation du CDN pour Tailwind CSS (à des fins de démonstration) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<?php
include 'header.php';
?>


<body class="bg-gray-100 ">

    <?php
    // Connexion à la base de données
    $mysqli = new mysqli("localhost", "root", "", "infoclimat");

    // Vérification de la connexion
    if ($mysqli->connect_error) {
        die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
    }

    // Format
    $mysqli->set_charset("utf8");

    // Requête pour récupérer les trois cartes les plus récentes de la table infocarte
    $result = $mysqli->query("SELECT id, titre, description, article, categorie, statut, pays, image FROM infoswiper");

    // Vérification s'il y a des résultats
    if ($result->num_rows > 0) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">

        <!-- ... Votre en-tête existant ... -->

        <body class="bg-gray-100 ">


            <div class="imageswip container  gap-4 md:p-12">
                <div class="intro text text-3xl font-bold  flex mb-8">
                    <h1>Information climatique :</h1>
                </div>
                <div class="swiper-container h-86 flex overflow-hidden ">

                    <div class="swiper-wrapper">
                        <?php
                        // Boucle à travers les résultats
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="testclass rainy swiper-slide relative border-2 bg-gray-100 rounded-2xl p-4  shadow-lg">
                                <div class="image1 relative h-64">
                                    <a href="article_catastrophe.php?id=<?php echo $row['id']; ?>">
                                        <?php
                                        if (empty($row['image'])) {
                                            // Afficher l'image par défaut si la colonne "image" est vide
                                            echo '<img src="Images/ImageClimat2.jpg" alt="Image par défaut" class="w-full h-full rounded-2xl object-cover">';
                                        } else {
                                            // Encodage de l'image en base64
                                            $imageData = base64_encode($row['image']);
                                            $imageType = "image/jpeg"; // Ajustez selon le type d'image dans votre base de données
                                
                                            // Affichage de l'image
                                            echo '<img src="data:' . $imageType . ';base64,' . $imageData . '" alt="Image ' . $row['id'] . '" class="w-full h-full object-fit rounded-2xl">';
                                        }
                                        ?>

                                        <div
                                            class="overlay absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                            <p class="text-black font-bold">
                                                <?php echo $row['description']; ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <!-- Ajoutez les flèches de navigation si vous le souhaitez 
                <div class="swiper-button-next text-white bg-blue-500 hover:bg-blue-600 rounded-full w-8 h-8 flex items-center justify-center absolute top-1/2 -translate-y-1/2 right-4 cursor-pointer"></div>
                <div class="swiper-button-prev text-white bg-blue-500 hover:bg-blue-600 rounded-full w-8 h-8 flex items-center justify-center absolute top-1/2 -translate-y-1/2 left-4 cursor-pointer"></div>-->
                </div>

                <script>
                    var swiper;

                    function initSwiper() {
                        var slidesPerView = (window.innerWidth < 768) ? 1 : 2; // Si l'écran est petit, affiche une seule image, sinon deux.

                        swiper = new Swiper('.swiper-container', {
                            slidesPerView: slidesPerView,
                            spaceBetween: 20,
                            loop: true,
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                            pagination: {
                                el: '.swiper-pagination',
                                clickable: true,
                            },
                            autoplay: {
                                delay: 4000,
                                disableOnInteraction: false,
                            },
                        });

                        // Gestion des événements de survol pour la pause/reprise du défilement
                        var swiperContainer = document.querySelector('.swiper-container');

                        swiperContainer.addEventListener('mouseenter', function () {
                            swiper.autoplay.stop();
                        });

                        swiperContainer.addEventListener('mouseleave', function () {
                            swiper.autoplay.start();
                        });
                    }

                    // Appeler la fonction initSwiper au chargement de la page
                    window.addEventListener('load', function () {
                        initSwiper();

                        // Mettre à jour le nombre de slides visibles si la fenêtre est redimensionnée
                        window.addEventListener('resize', function () {
                            swiper.destroy(); // Détruire l'instance Swiper existante
                            initSwiper(); // Initialiser une nouvelle instance Swiper
                        });
                    });
                </script>
            </div>

        </body>

        </html>

        <?php
    } else {
        echo "Aucun résultat trouvé dans la base de données.";
    }





    // Requête pour récupérer les trois cartes les plus récentes de la table infocarte
    $result = $mysqli->query("SELECT id, titre, description, article, categorie, statut, image FROM infocarte Where statut = 1  ORDER BY datecreation DESC LIMIT 3");


    // Vérification s'il y a des résultats
    if ($result->num_rows > 0) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">

        <!-- ... Votre en-tête existant ... -->
        </header>




        <div class="blog container pb-12">
            <div class="intro text text-3xl font-bold mb-8  flex">
                <h1>Dernières Actus :</h1>
            </div>
            <div class="grille grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3   gap-8">
                <?php
                // Boucle à travers les résultats
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="flex flex-col sm:flex-row col-span-1 row-span-1 sm:hover:shadow-lg rounded-3xl">
                        <div class=" rainy card1  border  w-96 h-full rounded-3xl shadow-lg text-black bg-green-600">
                            <div class="Photo flex justify-center">
                                <?php
                                if (empty($row['image'])) {
                                    // Afficher l'image par défaut si la colonne "image" est vide
                                    echo '<img src="Images/ImageClimat2.jpg" alt="Image par défaut" class="w-full h-44 rounded-t-3xl object-cover">';
                                } else {
                                    // Encodage de l'image en base64
                                    $imageData = base64_encode($row['image']);

                                    // Type de contenu de l'image (assurez-vous que cela correspond au type d'image dans votre base de données)
                                    $imageType = "image/jpeg"; // Exemple pour le format JPEG, ajustez selon votre besoin
                        
                                    // Affichage de l'image
                                    echo '<img src="data:' . $imageType . ';base64,' . $imageData . '" alt="image' . $row['id'] . '" class="w-full h-44 rounded-t-3xl object-cover">';
                                }
                                ?>
                            </div>

                            <div class="infocard pl-10 pt-4 pr-10">
                                <div class="flex flex-row">
                                    <?php echo $row['titre'] . ' :'; ?>
                                    <br>
                                    <?php echo $row['description']; ?>
                                </div>
                            </div>

                            <div class="boutonvalidation p-2 justify-end flex">
                                <a href="article.php?id=<?php echo $row['id']; ?>"
                                    class="bg-white px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
                                    <span class="text-black text-sm">En savoir plus</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </body>
    <?php
    } else {
        echo "Aucun résultat trouvé dans la base de données.";
    }

    // Fermer la connexion à la base de données
    $mysqli->close();
    ?>

</body>




=======
<div class="cookie-container" id="cookieContainer">
  <p>En visitant ce site web, vous acceptez notre politique d'utilisation des cookies. <a href="Images/louis.jpg">En savoir plus</a>.</p>
  <button class="accept-cookies-btn" id="acceptCookiesBtn">Accepter tous les cookies</button>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  var cookieContainer = document.getElementById('cookieContainer');
  var acceptCookiesBtn = document.getElementById('acceptCookiesBtn');
  
  // Vérifier si le cookie 'cookiesAccepted' existe
  if (getCookie('cookiesAccepted')) {
    // Masquer le conteneur de cookies s'il a déjà été accepté
    cookieContainer.style.display = 'none';
  }
  
  // Ajouter un écouteur d'événement au bouton pour créer le cookie
  acceptCookiesBtn.addEventListener('click', function() {
    // Créer un cookie qui expire dans 365 jours
    document.cookie = 'cookiesAccepted=true; expires=' + new Date(new Date().getTime() + 365 * 24 * 60 * 60 * 1000).toUTCString() + '; path=/';
    // Masquer le conteneur de cookies après avoir accepté
    cookieContainer.style.display = 'none';
  });
});  

// Fonction pour récupérer la valeur d'un cookie par son nom
function getCookie(name) {
  var cookies = document.cookie.split(';');
  for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i].trim();
    if (cookie.indexOf(name + '=') === 0) {
      return cookie.substring(name.length + 1);
    }
  }
  return null;
}
</script>

<?php
include 'footer.php';
?>

</html>