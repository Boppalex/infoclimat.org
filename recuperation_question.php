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

// Sélectionner aléatoirement 10 questions avec toutes leurs réponses
$sql = "SELECT q.id AS question_id, q.titre, q.description, r.id AS reponse_id, r.texte, r.estcorrect
        FROM question q
        LEFT JOIN reponse r ON q.id = r.id_question
        ORDER BY q.id, RAND()
        LIMIT 30";
$result = $conn->query($sql);

$questions = [];
$currentQuestion = null;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($currentQuestion === null || $currentQuestion['id'] !== $row['question_id']) {
            if ($currentQuestion !== null) {
                $questions[] = $currentQuestion;
            }

            $currentQuestion = [
                'id' => $row['question_id'],
                'titre' => $row['titre'],
                'description' => $row['description'],
                'reponses' => [],
            ];
        }

        $currentQuestion['reponses'][] = [
            'id' => $row['reponse_id'],
            'texte' => $row['texte'],
            'estcorrect' => $row['estcorrect'],
        ];
    }

    // Ajouter la dernière question
    $questions[] = $currentQuestion;
}

// Mélanger les questions pour les rendre aléatoires
shuffle($questions);

$conn->close();

// Envoyer les questions au format JSON
header('Content-Type: application/json');
echo json_encode($questions);
?>