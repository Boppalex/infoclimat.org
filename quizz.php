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
  <style>
    
    .quiz-container {
      max-width: 1100px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      background-color: #f9f9f9;
    }

    .question {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .question-title {
      font-size: 25px;
      margin-bottom: 5px;
    }

    .question-description {
      font-size: 14px;
      color: #666;
      margin-bottom: 15px;
    }

    .options {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    .option {
      margin: 10px 0;
    }

    input[type="radio"] {
      margin-right: 5px;
    }

    button {
      background-color: #055634;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }

    .message {
      font-weight: bold;
      margin-top: 10px;
    }

    .error {
      color: red;
      font-weight: bold;
    }

    .correct {
      color: green;
      font-weight: bold;
    }

  </style>
</head>
<?php
include 'header.php';
?>

<body class="bg-gray-100 ">
  <div class="contenu container">
    <div class="text text-3xl font-bold  flex mb-8">
      <h1>Quiz :</h1>
    </div>
    <div class="bg-gray-100 quiz-container ">
      <div id="questions"></div>
      <div id="message" class="message"></div>
      </br>
      <button onclick="checkAnswers()">Vérifier</button>
      </br>
      </br>
      <button id="restartButton" style="display: none;" onclick="restartQuiz()">Recommencer</button>
    </div>

    <script>
      // Fonction pour effectuer une requête AJAX
      function makeAjaxRequest(url, method, callback) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              if (xhr.responseText.trim() !== "") {  // Vérifiez si la réponse n'est pas vide
                callback(JSON.parse(xhr.responseText));
              } else {
                console.error("Réponse JSON vide.");
              }
            } else {
              console.error("Erreur de requête AJAX. Statut : " + xhr.status);
            }
          }
        };
        xhr.open(method, url, true);
        xhr.send();
      }

      let quizData = [];
      let selectedAnswers = [];

      function loadQuestions() {
        const questionsElement = document.getElementById("questions");
        questionsElement.innerHTML = "";

        quizData.forEach((quiz, index) => {
          const questionElement = document.createElement("div");
          questionElement.classList.add("question");

          // Ajoutez le titre de la question
          const titleElement = document.createElement("div");
          titleElement.classList.add("question-title");
          titleElement.innerText = quiz.titre;
          questionElement.appendChild(titleElement);

          // Ajoutez la description de la question
          const descriptionElement = document.createElement("div");
          descriptionElement.classList.add("question-description");
          descriptionElement.innerText = quiz.description;
          questionElement.appendChild(descriptionElement);

          const optionsElement = document.createElement("div");
          optionsElement.classList.add("options");

          const groupName = "q" + index + "_reponses"; // Utilisez un seul nom de groupe par question

          quiz.reponses.forEach((reponse, reponseIndex) => {
            const radio = document.createElement("input");
            radio.type = "radio";
            radio.value = reponse.texte;
            radio.id = "q" + index + "_reponse" + reponseIndex;
            radio.name = groupName; // Ajoutez le nom du groupe

            const label = document.createElement("label");
            label.innerText = reponse.texte;
            label.setAttribute("for", "q" + index + "_reponse" + reponseIndex);

            const optionElement = document.createElement("div");
            optionElement.classList.add("option");
            optionElement.appendChild(radio);
            optionElement.appendChild(label);
            optionsElement.appendChild(optionElement);
          });

          questionElement.appendChild(optionsElement);
          questionsElement.appendChild(questionElement);
        });

      // Ajoutez un gestionnaire d'événements à toutes les cases à cocher
      document.querySelectorAll('input[type="radio"]').forEach(function(checkbox) {
          checkbox.addEventListener('change', function() {
              // Recherchez l'élément de la page suivant la question actuelle
              var nextQuestion = this.closest('.question').nextElementSibling;
              if (nextQuestion) {
                  // Faites défiler la page automatiquement vers la question suivante
                  nextQuestion.scrollIntoView({ behavior: 'smooth', block: 'center' });
              }
          });
      });
      }

      let errorMessageDisplayed = false;

      function checkAnswers() {
        const questionsElement = document.getElementById("questions");
        const messageElement = document.getElementById("message");
        const restartButton = document.getElementById("restartButton");
        selectedAnswers = [];
        let errorCount = 0; // Ajoutez une variable pour compter le nombre d'erreurs

        // Vérifie si au moins une question n'a pas de réponse sélectionnée
        let allQuestionsAnswered = true;

        // Réinitialise le contenu du message à chaque vérification
        messageElement.innerText = "";
        errorMessageDisplayed = false;

        // Supprimez tous les messages d'erreur précédents
        questionsElement.querySelectorAll('.error').forEach(errorElement => errorElement.remove());

        questionsElement.querySelectorAll('.options').forEach((options, questionIndex) => {
          const radio = options.querySelector('input[type="radio"]:checked');

          if (!radio) {
            allQuestionsAnswered = false;
            return;  // Sort de la boucle si une question n'a pas de réponse
          }

          const userAnswer = radio.value;
          selectedAnswers.push({ questionIndex, userAnswer });

          const correctAnswer = quizData[questionIndex].reponses.find(r => r.estcorrect === "1");

          if (correctAnswer) {
            const isCorrect = userAnswer === correctAnswer.texte;

            if (!isCorrect) {
              errorCount++; // Incrémente le compteur d'erreurs
              const questionElement = options.previousElementSibling;
              const errorText = document.createElement("div");
              errorText.classList.add("error");
              errorText.innerText = "Erreur dans la réponse. La bonne réponse était : " + correctAnswer.texte;
              questionElement.appendChild(errorText);
            }

            options.querySelectorAll('input[type="radio"]').forEach(radio => radio.disabled = true);
          } else {
            console.error("Réponse correcte non trouvée pour la question " + questionIndex);
          }
        });

        // Affiche le message si au moins une question n'a pas de réponse
        if (!allQuestionsAnswered && !errorMessageDisplayed) {
          messageElement.innerText = "Veuillez répondre à toutes les questions avant de vérifier.";
          errorMessageDisplayed = true;
          return;
        }

        if (errorCount > 0 && !errorMessageDisplayed) {
          messageElement.innerText = "Il y a " + errorCount + " erreur(s). Veuillez vérifier les erreurs.";
          restartButton.style.display = "inline"; // Affichez le bouton "Recommencer"
          errorMessageDisplayed = true;
        } else if (!errorMessageDisplayed) {
          messageElement.innerText = "Les réponses sont correctes!";
          restartButton.style.display = "inline"; // Affichez le bouton "Recommencer"
          errorMessageDisplayed = true;
        }
      }

      function restartQuiz() {
        const questionsElement = document.getElementById("questions");
        const messageElement = document.getElementById("message");
        const restartButton = document.getElementById("restartButton");

        // Supprimez tous les messages d'erreur
        questionsElement.querySelectorAll('.error').forEach(errorElement => errorElement.remove());

        // Réinitialisez le message d'erreur/succès
        messageElement.innerText = "";

        // Réactivez tous les boutons radio
        questionsElement.querySelectorAll('input[type="radio"]').forEach(radio => radio.disabled = false);

        // Décochez tous les boutons radio
        questionsElement.querySelectorAll('input[type="radio"]').forEach(radio => radio.checked = false);

        // Cachez le bouton "Recommencer"
        restartButton.style.display = "none";


    // Défilez vers le haut de la page
    window.scrollTo(0, 0);   
}


      function arraysEqual(arr1, arr2) {
        if (arr1.length !== arr2.length) return false;
        for (let i = 0; i < arr1.length; i++) {
          if (arr1[i] !== arr2[i]) return false;
        }
        return true;
      }

      // Charger les questions à partir de la base de données
      makeAjaxRequest('recuperation_question.php', 'GET', function (data) {
        quizData = data;
        loadQuestions();
      });
    </script>
  </div>

</body>
</br>
<?php
include 'footer.php';
?>

</html>