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

<body class="bg-gray-100 ">


    <div class="text text-3xl font-bold mb-8 justify-center flex">
        <h1>Notre Blog :</h1>
    </div>
    <div class="blog flex justify-center pb-12">
        
        <div class="grille grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 xl:grid-rows-2  gap-8">
            <div class="flex flex-col sm:flex-row col-span-1 row-span-1 sm:hover:shadow-lg rounded-3xl">
                <div class="card1 border bg-white w-96 h-full rounded-3xl shadow-lg text-black bg-green-600">
                    <div class="Photo flex justify-center ">
                        <img src="Images/ImageClimat.jpg" alt="image4"
                            class="w-full h-44 rounded-t-3xl object-cover">
                    </div>
            
                    <div class="infocard pl-10 pt-4 pr-10">
            
                        <div class="flex flex-row ">
                            texte qui parel du climat et de la terre texte qui parel du climat et de la terre texte qui parel du climat et de la terre 
                        </div>
                    </div>
            
                    <div class="boutonvalidation p-2 justify-end flex">
                        <button class="bg-white text-white px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
                            <a href="#" class="text-black hover:text-white text-sm">En savoir plus</a>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row col-span-1 row-span-1 sm:hover:shadow-lg rounded-3xl">
                <div class="card1 border bg-white w-96 h-full rounded-3xl shadow-lg text-black bg-green-600">
                    <div class="Photo flex justify-center ">
                        <img src="Images/ImageClimat.jpg" alt="image4"
                            class="w-full h-44 rounded-t-3xl object-cover">
                    </div>
            
                    <div class="infocard pl-10 pt-4 pr-10">
            
                        <div class="flex flex-row ">
                            texte qui parel du climat et de la terre texte qui parel du climat et de la terre texte qui parel du climat et de la terre 
                        </div>
                    </div>
            
                    <div class="boutonvalidation p-2 justify-end flex">
                        <button class="bg-white text-white px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
                            <a href="#" class="text-black hover:text-white text-sm">En savoir plus</a>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row col-span-1 row-span-1 sm:hover:shadow-lg rounded-3xl">
                <div class="card1 border bg-white w-96 h-full rounded-3xl shadow-lg text-black bg-green-600">
                    <div class="Photo flex justify-center ">
                        <img src="Images/ImageClimat.jpg" alt="image4"
                            class="w-full h-44 rounded-t-3xl object-cover">
                    </div>
            
                    <div class="infocard pl-10 pt-4 pr-10">
            
                        <div class="flex flex-row ">
                            texte qui parel du climat et de la terre texte qui parel du climat et de la terre texte qui parel du climat et de la terre 
                        </div>
                    </div>
            
                    <div class="boutonvalidation p-2 justify-end flex">
                        <button class="bg-white text-white px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
                            <a href="#" class="text-black hover:text-white text-sm">En savoir plus</a>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row col-span-1 row-span-1 sm:hover:shadow-lg rounded-3xl">
                <div class="card1 border bg-white w-96 h-full rounded-3xl shadow-lg text-black bg-green-600">
                    <div class="Photo flex justify-center ">
                        <img src="Images/ImageClimat.jpg" alt="image4"
                            class="w-full h-44 rounded-t-3xl object-cover">
                    </div>
            
                    <div class="infocard pl-10 pt-4 pr-10">
            
                        <div class="flex flex-row ">
                            texte qui parel du climat et de la terre texte qui parel du climat et de la terre texte qui parel du climat et de la terre 
                        </div>
                    </div>
            
                    <div class="boutonvalidation p-2 justify-end flex">
                        <button class="bg-white text-white px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
                            <a href="#" class="text-black hover:text-white text-sm">En savoir plus</a>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row col-span-1 row-span-1 sm:hover:shadow-lg rounded-3xl">
                <div class="card1 border bg-white w-96 h-full rounded-3xl shadow-lg text-black bg-green-600">
                    <div class="Photo flex justify-center ">
                        <img src="Images/ImageClimat.jpg" alt="image4"
                            class="w-full h-44 rounded-t-3xl object-cover">
                    </div>
            
                    <div class="infocard pl-10 pt-4 pr-10">
            
                        <div class="flex flex-row ">
                            texte qui parel du climat et de la terre texte qui parel du climat et de la terre texte qui parel du climat et de la terre 
                        </div>
                    </div>
            
                    <div class="boutonvalidation p-2 justify-end flex">
                        <button class="bg-white text-white px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
                            <a href="#" class="text-black hover:text-white text-sm">En savoir plus</a>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row col-span-1 row-span-1 sm:hover:shadow-lg rounded-3xl">
                <div class="card1 border bg-white w-96 h-full rounded-3xl shadow-lg text-black bg-green-600">
                    <div class="Photo flex justify-center ">
                        <img src="Images/ImageClimat.jpg" alt="image4"
                            class="w-full h-44 rounded-t-3xl object-cover">
                    </div>
            
                    <div class="infocard pl-10 pt-4 pr-10">
            
                        <div class="flex flex-row ">
                            texte qui parel du climat et de la terre texte qui parel du climat et de la terre texte qui parel du climat et de la terre 
                        </div>
                    </div>
            
                    <div class="boutonvalidation p-2 justify-end flex">
                        <button class="bg-white text-white px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
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