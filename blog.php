
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

    <style>
        .btncat {
            background-color: #055634;
        }
    </style>

</head>
<?php
include 'header.php';
?>

<body class="bg-gray-100">
    <div>

    </div>
    <?php
    // Connexion à la base de données
    $mysqli = new mysqli("localhost", "root", "", "infoclimat");

    // Vérification de la connexion
    if ($mysqli->connect_error) {
        die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
    }

    // Format
    $mysqli->set_charset("utf8");

    // Initialiser la variable de catégorie
    $categorie = '';

    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer la catégorie sélectionnée (si elle existe)
        $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
    }

    // Requête pour récupérer les informations de la table infocarte avec filtrage par catégorie
    $query = "SELECT id, titre, description, article, categorie, statut, image FROM infocarte Where statut = '1'";

    // Ajouter le filtre de catégorie si une catégorie est sélectionnée
    if (!empty($categorie)) {
        // Utilisez la catégorie dans la clause WHERE de la requête
        $query .= " AND categorie = '" . $mysqli->real_escape_string($categorie) . "'";
    }

    // Exécuter la requête
    $result = $mysqli->query($query);

    // Vérification s'il y a des résultats
    if ($result->num_rows > 0) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">

        <body class="bg-gray-100 pt-8">

            <div class="blog container pb-12 pt-12">
                <div class="text text-3xl font-bold mb-8 ">
                    <h1>Notre Blog :</h1>
                </div>


                <form method="post" class="mb-4 flex items-center justify-center">
    <label for="categorie" class="mr-2">Filtrer par catégorie :</label>  
    <select name="categorie" id="categorie" class="border rounded p-1 mr-2" style="margin-top: -3px;">
        <option value="">Toutes les catégories</option>
        
        <?php
        $categoriesQuery = "SELECT DISTINCT categorie, categorie.label FROM infocarte INNER JOIN categorie ON infocarte.categorie = categorie.id";
   
        error_log($categoriesQuery);
        $categoriesResult = $mysqli->query($categoriesQuery);


        while ($categorieRow = $categoriesResult->fetch_assoc()) {
            $selected = ($categorie === $categorieRow['categorie']) ? 'selected' : '';
            echo '<option value="' . $categorieRow['categorie'] . '" ' . $selected . '>' . $categorieRow['label'] . '</option>';
        }
        ?>
    </select>
    <button type="submit" class="btncat text-white px-2 py-1 rounded" style="margin-top: -3px;">Filtrer</button>
</form>


                <div
                    class="grille grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 xl:grid-rows-2  gap-8">
                    <?php

                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="flex flex-col sm:flex-row col-span-1 row-span-1 sm:hover:shadow-lg rounded-3xl">
                            <div class="card1 border bg-white w-96 h-full rounded-3xl shadow-lg text-black bg-green-600">
                                <div class="Photo flex justify-center">
                                    <?php
                                    if (empty($row['image'])) {
                                        // Afficher l'image par défaut si la colonne "image" est vide
                                        echo '<img src="Images/ImageClimat.jpg" alt="Image par défaut" class="w-full h-44 rounded-t-3xl object-cover">';
                                    } else {
                                        // Encodage de l'image en base64 si la colonne "image" n'est pas vide
                                        $imageData = base64_encode($row['image']);
                                        $imageType = "image/jpeg"; // Assurez-vous que le type correspond à votre base de données
                                        // Afficher l'image depuis la base de données
                                        echo '<img src="data:' . $imageType . ';base64,' . $imageData . '" alt="image' . $row['id'] . '" class="w-full h-44 rounded-t-3xl object-cover">';
                                    }
                                    ?>
                                </div>

                                <div class="infocard pl-10 pt-4 pr-10">
                                    <div class="flex flex-row">
                                        <?php echo $row['description']; ?>
                                    </div>
                                </div>

                                <div class="boutonvalidation p-2 justify-end flex">
                                    <div class="boutonvalidation p-2 justify-end flex">
                                        <a href="article.php?id=<?php echo $row['id']; ?>"
                                            class="bg-white px-3 py-1 rounded-3xl transition-all duration-300 transform hover:scale-105 hover:bg-black border-2">
                                            <span class="text-black text-sm">En savoir plus</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                
            </div>
            <div class= "justify-center flex pb-8">
<button type="submit" class="btncat text-white px-2 py-1 rounded ml-2 centered-button" onclick="window.location.href = 'adduser.php';">Créer un article</button>
            </div>


        <?php
    } else {
        echo "Aucun résultat trouvé dans la base de données.";
    }

    // Fermer la connexion à la base de données
    $mysqli->close();
    ?>

</body>
<?php
include 'footer.php';
?>

</html>