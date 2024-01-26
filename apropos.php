<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>À Propos</title>
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

            <a href="index.html">
                <img src="images/terre1.jpg" alt="logo" class="w-32 h-32">
            </a>
            <nav class="flex flex-col sm:flex-row p-4 sm:p-8">
                <!-- Lien vers la page "blog" -->
                <div
                    class="hover:bg-gray-500 hover:text-white rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                    <a href="accueil.php" class="text-center flex items-center p-4 justify-center">Acceuil</a>
                </div>
                <div class="hover:bg-gray-500 hover:text-white rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                    <a href="blog.html" class="text-center flex items-center p-6 justify-center">Blog</a>
                </div>

                <!-- Lien vers la page "quizz" -->
                <div class="hover:bg-gray-500 hover:text-white rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                    <a href="quizz.php" class="text-center flex items-center p-5 justify-center">Quizz</a>
                </div>

                <!-- Lien vers la page "apropos" -->
                <div class="hover:bg-gray-500 hover:text-white rounded-full w-full sm:w-20 h-20 text-center flex">
                    <a href="apropos.html" class="text-center flex items-center p-1 justify-center">A propos</a>
                </div>
            </nav>
        </header>

    </div>
</div>




<body class="bg-gray-100">

    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-8">À Propos</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-8">
            <!-- Premier block -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-2">L'équipe : </h2>
                <p class="text-gray-700">- Cirade Adrien </br>- Bopp Alexandre </br>- Moreaux Hugo </br> - Bourguignon
                    Roman </br>- Azoulay Samuel </br> - Thomassin Steven</p>
            </div>

            <!-- Deuxième block -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <img src="Images/ImageClimat.jpg" alt="Image 1" class="w-full h-50 object-cover mb-4 rounded-lg">
            </div>

            <!-- Troisième block -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <img src="Images/nuitinfo.png" alt="Image 2" class="w-full h-50 object-cover mb-4 rounded-lg">
            </div>

            <!-- Quatrième block -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-2">Le projet : </h2>
                <p class="text-gray-700">Le projet vise à créer une application ludique permettant au grand public de
                    distinguer entre fausses informations et solutions réelles pour le climat. Face aux défis du
                    changement climatique, l'objectif est de fournir des informations claires, basées sur des données
                    chiffrées et des sources fiables. Porté par le Réseau Action Climat et le Bureau de la Nuit de
                    l'Info 2023, cette application vise à sensibiliser et éduquer un public sans connaissances
                    préalables sur le sujet et de montrer que des actions positives sont à notre portée.</p>
            </div>
        </div>
    </div>
</body>

<footer class="bg-green-600 p-4 w-full">
    <p class="flex justify-center">@SIO2Groupe2</p>
    <p class="flex justify-center">By Adrien Cirade, Roman Bourguignon, Steven Thomassin, Alexandre Bopp, Samuel
        Azoulay, Hugo Moreaux</p>
</footer>


</html>