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


<body class="bg-gray-100 ">

<?php
// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "infoclimat");

// Vérification de la connexion
if ($mysqli->connect_error) {
    die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
}

// Requête pour récupérer les trois cartes les plus récentes de la table infocarte
$result = $mysqli->query("SELECT id, titre, description, article, categorie, statut, image FROM infocarte ORDER BY datecreation DESC LIMIT 3");

// Vérification s'il y a des résultats
if ($result->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">

    <!-- ... Votre en-tête existant ... -->

    <body class="bg-gray-100 ">

        <div class="text text-3xl font-bold  justify-center flex">
            <h1>Information climatique :</h1>
        </div>
        <div class="bg-gray-100 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-6 gap-4 md:p-12">
            <div class="swiper-container h-86 flex overflow-hidden col-span-1 sm:col-start-1 sm:col-end-3 md:col-start-1 md:col-end-3 lg:col-start-2 lg:col-end-6">

                <div class="swiper-wrapper">
                    <?php
                    // Boucle à travers les résultats
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="swiper-slide relative bg-white border-2 rounded-2xl p-4  shadow-lg">
                            <div class="image1 relative h-64">
                                <a href="#">
                                    <?php
                                    // Encodage de l'image en base64
                                    $imageData = base64_encode($row['image']);
                                    $imageType = "image/jpeg"; // Ajustez selon le type d'image dans votre base de données

                                    // Affichage de l'image
                                    echo '<img src="data:' . $imageType . ';base64,' . $imageData . '" alt="Image ' . $row['id'] . '" class="w-full h-full object-cover rounded-2xl">';
                                    ?>

                                    <div class="overlay absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                        <p class="text-black font-bold"><?php echo $row['description']; ?></p>
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

// Fermer la connexion à la base de données
$mysqli->close();
?>

    

</body>

</html>