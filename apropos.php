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


</head>

<?php
include 'header.php';
?>

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
                <img src="Images/nous.jpg" alt="Image 1" class="w-full h-100 object-cover mb-4 rounded-lg">
            </div>

            <!-- Troisième block -->
            <div class="bg-white p-4 rounded-lg shadow-md">
                <img src="Images/nuitinfo.png" alt="Image 2" class="w-full h-100 object-cover mb-4 rounded-lg">
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