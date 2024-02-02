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

        body {
            margin: 0;
            background-color: #f3f4f6;
        }

        footer {
            background-color: #055634;
            color: white;

        }

        .raindrop {
            background-image: url('Images/goutte.png');
            /* Chemin vers votre image */
            background-size: cover;
            /* Ajustez selon vos besoins */
            background-repeat: no-repeat;
            position: absolute;
            width: 20px;
            /* Ajustez la largeur selon vos besoins */
            height: 20px;
            /* Ajustez la hauteur selon vos besoins */
            opacity: 0.8;
            transition: transform 0.5s linear;
        }

        header {
            background-image: url('Images/wave.png');
        }

        body.rainy header {

            background-image: url('Images/wavecloud.png');
        }

        /* Style appliqué uniquement lorsque la classe 'rainy' est présente sur le body */
        body.rainy {
            background-color: #708090;
            /* Fond gris clair */
        }

        div.testclass {
            background-color: #fff;
            /* Fond gris clair */
        }

        body.rainy div.testclass {
            background-color: #c3c3c3;
            /* Fond gris clair */
        }

        div.card1 {
            background-color: #fff;
            /* Fond gris clair */
        }

        body.rainy div.card1 {
            background-color: #c3c3c3;
            /* Fond gris clair */
        }



        body.rainy footer {
            background-color: #708090;
            overflow: hidden;
            /* Fond gris clair */

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
                <li class="nav-item">
                    <div class=" rounded-full w-full sm:w-20 h-20 text-center flex">
                        <div class="superposition-simple "><a href="apropos.php">
                                <div class="texte-normal ">
                                    <div class="texte-original">À propos</div>
                                </div>
                                <div class="texte-hover "><img decoding="async" class="image-originale "
                                        src="Images/glace.png" />
                                    <div class="texte-original">À propos</div>
                                </div>
                            </a></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<body class="bg-gray-100 ">
    <script>
        let easterEggActive = false;
        let ctrlPressed = false;
        let originalBackgroundColor = document.body.style.backgroundColor;

        // Fonction pour générer une goutte de pluie
        function createRaindrop() {
            const raindrop = document.createElement('div');
            raindrop.className = 'raindrop';
            raindrop.style.top = '0';
            raindrop.style.left = Math.random() * window.innerWidth + 'px';
            document.body.appendChild(raindrop);

            // Utilisation d'une fonction de rappel pour réinitialiser la position après la transition
            setTimeout(() => {
                raindrop.style.transform = 'translateY(' + (document.body.offsetHeight - 0) + 'px)';
            }, 0);


            // Détection quand la goutte atteint le bas de la page et la supprimer
            setTimeout(() => {
                document.body.removeChild(raindrop);
            }, 2000);
        }

        // Générer plusieurs gouttes de pluie en continu
        setInterval(() => {
            if (easterEggActive) {
                for (let i = 0; i < 1; i++) { // Ajoutez 5 gouttes à la fois
                    createRaindrop();
                }
            }
        }, 50); // Ajoutez une nouvelle série de gouttes toutes les 100 millisecondes

        // Écouteur d'événement pour détecter la pression de la touche Ctrl
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Control') {
                ctrlPressed = true;
            } else if (ctrlPressed && event.key === '1') {
                easterEggActive = !easterEggActive;
                document.body.classList.toggle('rainy', easterEggActive);
            }
        });

        // Écouteur d'événement pour détecter le relâchement de la touche Ctrl
        document.addEventListener('keyup', function (event) {
            if (event.key === 'Control') {
                ctrlPressed = false;
            }
        });

        // Écouteur d'événement pour détecter le scroll
        window.addEventListener('scroll', function () {
            // Si l'utilisateur a atteint la fin de la page, supprimez toutes les gouttes de pluie
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                const raindrops = document.querySelectorAll('.raindrop');
                raindrops.forEach((raindrop) => {
                    document.body.removeChild(raindrop);
                });
            }
        });
    </script>

    <?php
    // Connexion à la base de données
    $mysqli = new mysqli("localhost", "root", "", "infoclimat");

    // Vérification de la connexion
    if ($mysqli->connect_error) {
        die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
    }

    // Requête pour récupérer les trois cartes les plus récentes de la table infocarte
    $result = $mysqli->query("SELECT id, titre, description, article, categorie, statut, image FROM infocarte ");

    // Vérification s'il y a des résultats
    if ($result->num_rows > 0) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">

        <!-- ... Votre en-tête existant ... -->

        <body class="bg-gray-100 ">


            <div class="imageswip container  gap-4 md:p-12">
                <div class="text text-3xl font-bold  flex mb-8">
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
                                    <a href="#">
                                        <?php
                                        // Encodage de l'image en base64
                                        $imageData = base64_encode($row['image']);
                                        $imageType = "image/jpeg"; // Ajustez selon le type d'image dans votre base de données
                                
                                        // Affichage de l'image
                                        echo '<img src="data:' . $imageType . ';base64,' . $imageData . '" alt="Image ' . $row['id'] . '" class="w-full h-full object-cover rounded-2xl">';
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
    $result = $mysqli->query("SELECT id, titre, description, article, categorie, statut, image FROM infocarte ORDER BY datecreation DESC LIMIT 3");


    // Vérification s'il y a des résultats
    if ($result->num_rows > 0) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">

        <!-- ... Votre en-tête existant ... -->
        </header>




        <div class="blog container pb-12">
            <div class="text text-3xl font-bold mb-8  flex">
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
                                // Encodage de l'image en base64
                                $imageData = base64_encode($row['image']);

                                // Type de contenu de l'image (assurez-vous que cela correspond au type d'image dans votre base de données)
                                $imageType = "image/jpeg"; // Exemple pour le format JPEG, ajustez selon votre besoin
                        
                                // Affichage de l'image
                                echo '<img src="data:' . $imageType . ';base64,' . $imageData . '" alt="image' . $row['id'] . '" class="w-full h-44 rounded-t-3xl object-cover">';
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
                                <button
                                    class="bg-white  px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
                                    <a href="#" class="text-black hover:text-black text-sm">En savoir plus</a>
                                </button>
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

<footer class=" rainy footerpage  p-4  w-full">
    <p class="flex justify-center">@SIO2Groupe2</p>
    <p class="flex justify-center">By Adrien Cirade, Roman Bourguignon, Steven Thomassin, Alexandre Bopp, Samuel
        Azoulay, Hugo Moreaux</p>
</footer>

</html>