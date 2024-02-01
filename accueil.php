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
<header class="entete flex flex-col sm:flex-row justify-center items-center p-1 sm:p-8 md:p-16 lg:p-20 xl:p-24 bg-cover bg-center h-300 sm:h-200 md:h-250 lg:h-300 xl:h-500" style="background-image: url('Images/wave.png');">
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
                    <div class="hover:bg-gray-500 hover:text-white rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                        <a href="accueil.php" class="text-center flex items-center justify-center text-black hover:text-white">Accueil</a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="hover:bg-gray-500 hover:text-white rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                        <a href="blog.php" class="text-center flex items-center justify-center text-black hover:text-white">Blog</a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="hover:bg-gray-500 hover:text-white rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                        <a href="quizz.php" class="text-center flex items-center justify-center text-black hover:text-white">Quizz</a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="hover:bg-gray-500 hover:text-white rounded-full w-full sm:w-20 h-20 text-center flex">
                        <a href="apropos.php" class="text-center flex items-center justify-center text-black hover:text-white">À propos</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<body class="bg-gray-100 pt-8">

    <div class="text text-3xl font-bold  justify-center flex">
        <h1>Information climatique :</h1>
    </div>
    <div class="bg-gray-100 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-6 gap-4 md:p-12">
        <div
            class="swiper-container h-86 flex overflow-hidden col-span-1 sm:col-start-1 sm:col-end-3 md:col-start-1 md:col-end-3 lg:col-start-2 lg:col-end-6">
            <div class="swiper-wrapper">
                <div class="swiper-slide relative bg-white border-2 rounded-2xl p-4  shadow-lg">
                    <div class="image1 relative">
                        <a href="#">
                            <img src="Images/ImageClimat.jpg" alt="Image 1"
                                class="w-full h-full object-cover rounded-2xl">
                            <div
                                class="overlay absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                <p class="text-white font-bold">Description</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="swiper-slide relative bg-white border-2 rounded-2xl p-4  shadow-lg">
                    <div class="image2 relative">
                        <a href="#">
                            <img src="Images/nuitinfo.png" alt="Image 2" class="w-full h-full object-cover rounded-2xl">
                            <div
                                class="overlay absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                <p class="text-white font-bold">Description</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="swiper-slide relative bg-white border-2 rounded-2xl p-4  shadow-lg">
                    <div class="image3 relative">
                        <a href="#">
                            <img src="Images/ImageClimat.jpg" alt="Image 3"
                                class="w-full h-full object-cover rounded-2xl">
                            <div
                                class="overlay absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                <p class="text-white font-bold">Description</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="swiper-slide relative bg-white border-2 rounded-2xl p-4  shadow-lg">
                    <div class="image4 relative">
                        <a href="#">
                            <img src="Images/ImageClimat2.jpg" alt="Image 4"
                                class="w-full h-full object-cover rounded-2xl">
                            <div
                                class="overlay absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                <p class="text-white font-bold">Description</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="swiper-slide relative bg-white border-2 rounded-2xl p-4  shadow-lg">
                    <div class="image5 relative">
                        <a href="#">
                            <img src="Images/ImageClimat.jpg" alt="Image 5"
                                class="w-full h-full object-cover rounded-2xl">
                            <div
                                class="overlay absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                <p class="text-white font-bold">Description</p>
                            </div>
                        </a>
                    </div>
                </div>
                
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination xl:py-12"></div>

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

    <div class="text text-3xl font-bold  justify-center flex mb-8">
        <h1>Dernières Actus :</h1>
    </div>
    <div class="carte flex justify-center pb-8">
        <div class="ligne flex flex-col xl:flex-row gap-6">
            <div class=" hover:shadow-lg rounded-3xl">
                <div class="card1 border bg-white w-96 h-full rounded-3xl shadow-lg text-black bg-green-600">
                    <div class="Photo flex justify-center ">
                        <img src="Images/ImageClimat.jpg" alt="image4" class="w-full h-44 rounded-t-3xl object-cover">
                    </div>

                    <div class="infocard pl-10 pt-4 pr-10">

                        <div class="flex flex-row ">
                            texte qui parel du climat et de la terre texte qui parel du climat et de la terre texte qui
                            parel du climat et de la terre
                        </div>
                    </div>

                    <div class="boutonvalidation p-2 justify-end flex">
                        <button
                            class="px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
                            <a href="#" class="text-black hover:text-white text-sm">En savoir plus</a>
                        </button>
                    </div>
                </div>
            </div>

            <div class="  hover:shadow-lg rounded-3xl">
                <div class="card1 border bg-white w-96 h-full rounded-3xl shadow-lg text-black bg-green-600">
                    <div class="Photo flex justify-center ">
                        <img src="Images/ImageClimat.jpg" alt="image4" class="w-full h-44 rounded-t-3xl object-cover">
                    </div>

                    <div class="infocard pl-10 pt-4 pr-10">

                        <div class="flex flex-row ">
                            texte qui parel du climat et de la terre texte qui parel du climat et de la terre texte qui
                            parel du climat et de la terre
                        </div>
                    </div>

                    <div class="boutonvalidation p-2 justify-end flex">
                        <button
                            class="px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
                            <a href="#" class="text-black hover:text-white text-sm">En savoir plus</a>
                        </button>
                    </div>
                </div>
            </div>

            <div class="  hover:shadow-lg rounded-3xl">
                <div class="card1 border bg-white w-96 h-full rounded-3xl shadow-lg text-black bg-green-600">
                    <div class="Photo flex justify-center ">
                        <img src="Images/ImageClimat.jpg" alt="image4" class="w-full h-44 rounded-t-3xl object-cover">
                    </div>

                    <div class="infocard pl-10 pt-4 pr-10">

                        <div class="flex flex-row ">
                            texte qui parel du climat et de la terre texte qui parel du climat et de la terre texte qui
                            parel du climat et de la terre
                        </div>
                    </div>

                    <div class="boutonvalidation p-2 justify-end flex">
                        <button
                            class="px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
                            <a href="#" class="text-black hover:text-white text-sm">En savoir plus</a>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
<footer class="bg-green-600 p-4  w-full">
    <p class="flex justify-center">@SIO2Groupe2</p>
    <p class="flex justify-center">By Adrien Cirade, Roman Bourguignon, Steven Thomassin, Alexandre Bopp, Samuel
        Azoulay, Hugo Moreaux</p>
</footer>

</html>