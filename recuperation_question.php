<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "infoclimat";

try {
    // Créer une connexion PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sélectionner aléatoirement 10 questions avec toutes leurs réponses
    $sql = "SELECT q.id AS question_id, q.titre, q.description, r.id AS reponse_id, r.texte, r.estcorrect
            FROM question q
            LEFT JOIN reponse r ON q.id = r.id_question
            ORDER BY q.id, RAND()
            LIMIT 30";
    $stmt = $conn->query($sql);

    $questions = [];
    $currentQuestion = null;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
    if ($currentQuestion !== null) {
        $questions[] = $currentQuestion;
    }

    // Mélanger les questions pour les rendre aléatoires
    shuffle($questions);

    // Envoyer les questions au format JSON
    header('Content-Type: application/json');
    echo json_encode($questions);
} catch (PDOException $e) {
    die("La connexion a échoué : " . $e->getMessage());
}
