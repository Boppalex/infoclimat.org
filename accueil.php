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
</head>
<div class="headertest grid grid-cols-1 grid-rows-1 top-0">
    <div class="flex col-start-1 col-end-2 row-start-1 row-end-2 bg-green-600 xl:bg-gray-100">
        <svg class="header-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#059669" fill-opacity="1"
                d="M0,96L60,122.7C120,149,240,203,360,229.3C480,256,600,256,720,245.3C840,235,960,213,1080,186.7C1200,160,1320,128,1380,112L1440,96L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
            </path>
        </svg>
    </div>
    <div class="flex col-start-1 col-end-2 row-start-1 row-end-2 justify-center">
        <!-- Correction de la balise <header> -->
        <header class="entete flex flex-col sm:flex-row justify-center p-1 sm:p-8 md:p-16 lg:p-20 xl:p-24">

            <a href="accueil.php">
                <img src="images/terre1.jpg" alt="logo" class="w-32 h-32">
            </a>
            <nav class="flex flex-col sm:flex-row p-4 sm:p-8">
                <!-- Lien vers la page "blog" -->
                <div
                    class="hover:bg-gray-500 hover:text-white rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                    <a href="accueil.php" class="text-center flex items-center p-4 justify-center">Accueil</a>
                </div>
                <div
                    class="hover:bg-gray-500 hover:text-white rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                    <a href="blog.php" class="text-center flex items-center p-6 justify-center">Blog</a>
                </div>

                <!-- Lien vers la page "quizz" -->
                <div
                    class="hover:bg-gray-500 hover:text-white rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                    <a href="quizz.php" class="text-center flex items-center p-5 justify-center">Quizz</a>
                </div>

                <!-- Lien vers la page "apropos" -->
                <div class="hover:bg-gray-500 hover:text-white rounded-full w-full sm:w-20 h-20 text-center flex">
                    <a href="apropos.php" class="text-center flex items-center p-1 justify-center">A propos</a>
                </div>
            </nav>
        </header>

    </div>
</div>

<body class="bg-gray-100">

    <div class="text text-3xl font-bold  justify-center flex">
        <h1>Information climatique :</h1>
    </div>
    <div class="bg-gray-100 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-6 gap-4 p-12">
        <div
            class="swiper-container h-86 flex overflow-hidden col-start-1 col-end-2 sm:col-start-1 sm:col-end-3 md:col-start-1 md:col-end-3 lg:col-start-2 lg:col-end-6">
            <div class="swiper-wrapper">
                <div class="swiper-slide bg-white border-2 rounded-2xl p-4  shadow-lg">
                    <a href="#"><img src="Images/ImageClimat.jpg" alt="Image 1"
                            class="w-full h-full object-cover rounded-2xl"></a>
                </div>
                <div class="swiper-slide bg-white p-4 border-2 rounded-2xl shadow-lg">
                    <a href="#"><img src="Images/nuitinfo.png" alt="Image 2" class="w-full h-full object-cover rounded-2xl"></a>
                </div>
                <div class="swiper-slide bg-white p-4 border-2 rounded-2xl shadow-lg">
                    <a href="#"><img src="Images/ImageClimat.jpg" alt="Image 3"
                            class="w-full h-full object-cover rounded-2xl"></a>
                </div>
                <div class="swiper-slide bg-white p-4 border-2 rounded-2xl shadow-lg">
                    <a href="#"><img src="Images/ImageClimat2.jpg" alt="Image 4"
                            class="w-full h-full object-cover rounded-2xl"></a>
                </div>
                <div class="swiper-slide bg-white p-4 border-2 rounded-2xl shadow-lg">
                    <a href="#"><img src="Images/ImageClimat.jpg" alt="Image 5"
                            class="w-full h-full object-cover rounded-2xl"></a>
                </div>
                
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination   xl:py-12"></div>

            <!-- Ajoutez les flèches de navigation si vous le souhaitez 
        <div class="swiper-button-next text-white bg-blue-500 hover:bg-blue-600 rounded-full w-8 h-8 flex items-center justify-center absolute top-1/2 -translate-y-1/2 right-4 cursor-pointer"></div>
        <div class="swiper-button-prev text-white bg-blue-500 hover:bg-blue-600 rounded-full w-8 h-8 flex items-center justify-center absolute top-1/2 -translate-y-1/2 left-4 cursor-pointer"></div>-->
        </div>

        <script>
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 2,
                spaceBetween: 20,
                loop: true, // Activer la boucle infinie
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                },
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false, // Permet à l'autoplay de ne pas être désactivé au toucher de l'utilisateur
                },
            });
        
            // Ajouter la gestion des événements de survol pour la pause/reprise du défilement
            var swiperContainer = document.querySelector('.swiper-container');
        
            swiperContainer.addEventListener('mouseenter', function () {
                swiper.autoplay.stop();
            });
        
            swiperContainer.addEventListener('mouseleave', function () {
                swiper.autoplay.start();
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
                            class="bg-white text-white px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
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
                            class="bg-white text-white px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
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
                            class="bg-white text-white px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
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