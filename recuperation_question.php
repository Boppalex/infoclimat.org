<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "infoclimat";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Sélectionner les questions avec leurs réponses
$sql = "SELECT q.id, q.titre, q.description, r.texte, r.estcorrect FROM question q INNER JOIN reponse r ON q.id = r.id_question";
$result = $conn->query($sql);

$questions = [];
$currentQuestion = null;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($currentQuestion === null || $currentQuestion['id'] !== $row['id']) {
            if ($currentQuestion !== null) {
                $questions[] = $currentQuestion;
            }

            $currentQuestion = [
                'id' => $row['id'],
                'titre' => $row['titre'],
                'description' => $row['description'],
                'reponses' => [],
            ];
        }

        $currentQuestion['reponses'][] = [
            'texte' => $row['texte'],
            'estcorrect' => $row['estcorrect'],
        ];
    }

    // Ajouter la dernière question
    $questions[] = $currentQuestion;
}

$conn->close();

// Envoyer les questions au format JSON
header('Content-Type: application/json');
echo json_encode($questions);
?>