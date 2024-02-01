<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      margin: 20px;
    }
    .quiz-container {
      max-width: auto;
      margin: 0 auto;
    }
    .question {
      font-size: 18px;
      text-align: left;
      margin-bottom: 10px;
      margin-left: 20px;
    }
    .options {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      margin-top: 10px;
    }
    .option {
      margin: 5px 0;
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

    </div>
</div>

<body>

<div class="bg-gray-100  quiz-container">
  <div id="questions"></div>
  <div id="message" class="message"></div>
  <button onclick="checkAnswers()">Vérifier</button>
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
          callback(JSON.parse(xhr.responseText));
        } else {
          console.error("Erreur de requête AJAX");
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
}

function checkAnswers() {
  const questionsElement = document.getElementById("questions");
  const messageElement = document.getElementById("message");
  const restartButton = document.getElementById("restartButton");
  selectedAnswers = [];
  let hasErrors = false;
  let allRadiosUnchecked = true;

  questionsElement.querySelectorAll('.options').forEach((options, questionIndex) => {
    const radio = options.querySelector('input[type="radio"]:checked');

    if (radio) {
      allRadiosUnchecked = false;

      const userAnswer = radio.value;
      selectedAnswers.push({ questionIndex, userAnswer });

      const correctAnswer = quizData[questionIndex].reponses.find(r => r.estcorrect === "1");

      if (correctAnswer) {
        const isCorrect = userAnswer === correctAnswer.texte;

        if (!isCorrect) {
          hasErrors = true;
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
    }
  });

  if (allRadiosUnchecked) {
    messageElement.innerText = "Veuillez sélectionner au moins une réponse avant de vérifier.";
  } else if (hasErrors) {
    messageElement.innerText = "Certains éléments sont incorrects. Veuillez vérifier les erreurs.";
    restartButton.style.display = "inline"; // Affichez le bouton "Recommencer"
  } else {
    messageElement.innerText = "Les réponses sont correctes!";
    restartButton.style.display = "inline"; // Affichez le bouton "Recommencer"
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
</body>
<footer class="bg-green-600 p-4  w-full">
    <p class="flex justify-center">@SIO2Groupe2</p>
    <p class="flex justify-center">By Adrien Cirade, Roman Bourguignon, Steven Thomassin, Alexandre Bopp, Samuel
        Azoulay, Hugo Moreaux</p>
</footer>
</html>
