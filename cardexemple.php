<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pluie Animée</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            background-color: #f3f4f6;
        }

        .raindrop {
            position: absolute;
            width: 2px;
            height: 10px;
            background-color: #00f;
            opacity: 0.8;
            transition: transform 0.5s linear;
        }

        /* Style appliqué uniquement lorsque la classe 'rainy' est présente sur le body */
        body.rainy {
            background-color: #708090;
            /* Fond gris clair */
        }
    </style>
</head>

<body>

    <script>
        let easterEggActive = false;
        let ctrlPressed = false;
        let originalBackgroundColor = document.body.style.backgroundColor;

        // Fonction pour générer une goutte de pluie
        function createRaindrop() {
            const raindrop = document.createElement('div');
            raindrop.className = 'raindrop';
            raindrop.style.top = '0';
            raindrop.style.left = Math.random() * window.innerWidth + 'px';
            document.body.appendChild(raindrop);

            // Utilisation d'une fonction de rappel pour réinitialiser la position après la transition
            setTimeout(() => {
                raindrop.style.transform = 'translateY(' + window.innerHeight + 'px)';
            }, 0);

            // Détection quand la goutte atteint le bas de la page et la supprimer
            raindrop.addEventListener('transitionend', function () {
                document.body.removeChild(raindrop);
            });
        }

        // Générer plusieurs gouttes de pluie en continu
        setInterval(() => {
            if (easterEggActive) {
                for (let i = 0; i < 20; i++) { // Ajoutez 5 gouttes à la fois
                    createRaindrop();
                }
            }
        }, 100); // Ajoutez une nouvelle série de gouttes toutes les 100 millisecondes

        // Écouteur d'événement pour détecter la pression de la touche Ctrl
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Control') {
                ctrlPressed = true;
            } else if (ctrlPressed && event.key === '1') {
                easterEggActive = !easterEggActive;
                document.body.classList.toggle('rainy', easterEggActive);
            }
        });

        // Écouteur d'événement pour détecter le relâchement de la touche Ctrl
        document.addEventListener('keyup', function (event) {
            if (event.key === 'Control') {
                ctrlPressed = false;
            }
        });

        // Écouteur d'événement pour détecter le scroll
        window.addEventListener('scroll', function () {
            // Si l'utilisateur a atteint la fin de la page, supprimez toutes les gouttes de pluie
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                const raindrops = document.querySelectorAll('.raindrop');
                raindrops.forEach((raindrop) => {
                    document.body.removeChild(raindrop);
                });
            }
        });
    </script>

</body>

</html>
