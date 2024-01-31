<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
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

<body class="bg-gray-100">
    <h1>Welcome to the Quiz!</h1>
    <form action="quiz.php" method="post">
        <!-- Add your quiz questions and options here -->
        <input type="submit" value="Submit">
    </form>
</body>
<footer class="bg-green-600 p-4 fixed bottom-0 w-full">
    <p class="flex justify-center">@SIO2Groupe2</p>
    <p class="flex justify-center">By Adrien Cirade, Roman Bourguignon, Steven Thomassin, Alexandre Bopp, Samuel
        Azoulay, Hugo Moreaux</p>
</footer>
</html>
