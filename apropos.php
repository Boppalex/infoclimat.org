<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>À Propos</title>
    <style>

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
    </style>
    
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
                    <div class=" rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                        <div class="superposition-simple  "><a href="accueil.php"><div class="texte-normal "><div class="texte-original ">Accueil</div></div><div class="texte-hover "><img decoding="async" class="image-originale " src="Images/feuille.png" /><div class="texte-original">Accueil</div></div></a></div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class=" rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                        <div class="superposition-simple "><a href="blog.php"><div class="texte-normal "><div class="texte-original">Blog</div></div><div class="texte-hover "><img decoding="async" class="image-originale " src="Images/nuage.png" /><div class="texte-original">Blog</div></div></a></div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class=" rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                        <div class="superposition-simple "><a href="quizz.php"><div class="texte-normal "><div class="texte-original">Quizz</div></div><div class="texte-hover "><img decoding="async" class="image-originale " src="Images/soleil.png" /><div class="texte-original">Quizz</div></div></a></div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class=" rounded-full w-full sm:w-20 h-20 text-center flex">
                        <div class="superposition-simple "><a href="apropos.php"><div class="texte-normal "><div class="texte-original">À propos</div></div><div class="texte-hover "><img decoding="async" class="image-originale " src="Images/glace.png" /><div class="texte-original">À propos</div></div></a></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

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
                <img src="Images/ImageClimat.jpg" alt="Image 1" class="w-full h-full object-cover mb-4 rounded-lg">
            </div>

            <!-- Troisième block -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <img src="Images/nuitinfo.png" alt="Image 2" class="w-full h-full object-cover mb-4 rounded-lg">
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

<footer class=" p-4 w-full">
    <p class="flex justify-center">@SIO2Groupe2</p>
    <p class="flex justify-center">By Adrien Cirade, Roman Bourguignon, Steven Thomassin, Alexandre Bopp, Samuel
        Azoulay, Hugo Moreaux</p>
</footer>


</html>