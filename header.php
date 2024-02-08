<?php
session_start();

require_once "connect.php";

// Vérifiez si l'utilisateur est connecté
$logged_in = isset($_SESSION['username']);

// Si l'utilisateur est connecté, récupérez le nom d'utilisateur
$username = '';
$is_admin = false; // Par défaut, l'utilisateur n'est pas un administrateur
if ($logged_in) {
    // Supposons que vous stockiez le nom d'utilisateur dans une variable de session appelée 'username'
    $username = $_SESSION['username'];

    // Préparation de la requête SQL pour récupérer isadmin de la base de données
    $sql = "SELECT isadmin FROM utilisateur WHERE nom = :username";

    // Préparation de la requête
    $query = $db->prepare($sql);

    // Exécution de la requête
    $query->execute([':username' => $username]);

    // Récupération des résultats
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Si la requête a retourné un résultat valide, mettez à jour la variable $is_admin
    if ($result !== false) {
        $is_admin = (int) $result['isadmin']; // Convertit la valeur en entier
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        html,
        body {

            padding: 0;
            margin: 0;
            position: relative;
            transition: background 4s ease;
            /* Transition pour le changement de fond */
        }

        /* CSS */
        a.testa .hidden.sm\:inline-block {
            display: none;
        }

        a.testa:hover .hidden.sm\:inline-block {
            display: inline-block;
        }


        /* Ajout d'une classe pour le fond pendant l'easter egg */
        body.rainy {
            background: #333;
            /* Couleur du fond pendant l'easter egg */
        }

        .superposition-simple {
            position: relative;
            width: 100%;
        }

        .superposition-simple .image-originale {
            display: block;
            width: 100%;
            height: auto;
        }

        .superposition-simple .texte-original {
            color: #fff;
            font-size: 20px;
            line-height: 1.5em;
            text-shadow: 2px 2px 2px #000;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
        }

        .superposition-simple .texte-hover {
            position: absolute;
            top: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .5s ease;
        }

        .superposition-simple:hover .texte-normal {
            opacity: 0;
        }

        .superposition-simple:hover .texte-hover {
            opacity: 1;
        }

        .superposition-simple .texte-normal {
            transition: .5s ease;
        }

        body {
            margin: 0;
            background-color: #f3f4f6;
        }

        footer {
            background-color: #055634;
            color: white;

        }

        header {
            background-image: url('Images/wave.png');
        }


        div.testclass {
            background-color: #fff;
            /* Fond gris clair */
        }

        body.rainy div.testclass {
            background-color: #ffff;
            color: #fff;
            /* Fond gris clair */
        }

        body.rainy div.intro {
            color: #fff;
            /* Fond gris clair */
        }



        div.card1 {
            background-color: #fff;
            /* Fond gris clair */
        }

        body.rainy div.card1 {
            background-color: #ffff;
            /* Fond gris clair */
        }

        body.rainy header {
            background-image: none;
        }

        body.rainy footer {

            background-color: #333;
            overflow: hidden;
            transition: background 4s ease;
            /* Fond gris clair */

        }

        .cookie-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #f5f5f5;
            padding: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            z-index: 1000;
        }

        .cookie-container p {
            flex: 1;
            margin-right: 1rem;
        }

        .accept-cookies-btn {
            appearance: none;
            background-color: #4CAF50;
            color: white;
            padding: 0.5rem 1rem;
            text-transform: uppercase;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .accept-cookies-btn:hover {
            background-color: #3e8e41;
        }

        .accept-cookies-btn:focus {
            outline: none;
            box-shadow: 0 0 0 3px #3e8e41;
        }

        .cookie-container.hide {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease;
        }
    </style>
    <script type="text/javascript">

        document.addEventListener("keydown", function (event) {
            // Vérifier si la touche Ctrl (ou Commande sur Mac) est enfoncée et la touche 9 est pressée
            if ((event.ctrlKey || event.metaKey) && event.key === "9") {
                // Rediriger vers la page souhaitée, par exemple "nouvelle_page.html"
                window.location.href = "backend.php";
            }
        });


        var snow = {
            wind: 0,
            maxXrange: 100,
            minXrange: 10,
            maxSpeed: 2,
            minSpeed: 1,
            color: "#fff",
            char: "*",
            maxSize: 20,
            minSize: 8,
            flakes: [],
            WIDTH: 0,
            HEIGHT: 0,
            snowActive: false,

            init: function (nb) {
                var o = this,
                    frag = document.createDocumentFragment();
                o.getSize();

                for (var i = 1; i < nb; i++) {
                    var flake = {
                        x: o.random(o.WIDTH),
                        y: -o.maxSize,
                        xrange: o.minXrange + o.random(o.maxXrange - o.minXrange),
                        yspeed: o.minSpeed + o.random(o.maxSpeed - o.minSpeed, 100),
                        life: 0,
                        size: o.minSize + o.random(o.maxSize - o.minSize),
                        html: document.createElement("span"),
                    };

                    flake.html.style.position = "absolute";
                    flake.html.style.top = flake.y + "px";
                    flake.html.style.left = flake.x + "px";
                    flake.html.style.fontSize = flake.size + "px";
                    flake.html.style.color = o.color;
                    flake.html.appendChild(document.createTextNode(o.char));

                    frag.appendChild(flake.html);
                    o.flakes.push(flake);
                }

                document.body.appendChild(frag);
                o.animate();

                window.onresize = function () {
                    o.getSize();
                };
            },

            animate: function () {
                var o = this;
                for (var i = 0, c = o.flakes.length; i < c; i++) {
                    var flake = o.flakes[i],
                        top = flake.y + flake.yspeed,
                        left = flake.x + Math.sin(flake.life) * flake.xrange + o.wind;
                    if (top < o.HEIGHT - flake.size - 10 && left < o.WIDTH - flake.size && left > 0) {
                        flake.html.style.top = top + "px";
                        flake.html.style.left = left + "px";
                        flake.y = top;
                        flake.x += o.wind;
                        flake.life += 0.01;
                    } else {
                        flake.html.style.top = -o.maxSize + "px";
                        flake.x = o.random(o.WIDTH);
                        flake.y = -o.maxSize;
                        flake.html.style.left = flake.x + "px";
                        flake.life = 0;
                    }
                }

                // Continue l'animation seulement si la neige est activée
                if (o.snowActive) {
                    setTimeout(function () {
                        o.animate();
                    }, 20);
                }
            },

            random: function (range, num) {
                var num = num ? num : 1;
                return Math.floor(Math.random() * (range + 5) * num) / num;
            },

            getSize: function () {
                this.WIDTH = document.body.clientWidth || window.innerWidth;
                this.HEIGHT = document.body.clientHeight || window.innerHeight;
            },

            toggleSnow: function () {
                this.snowActive = !this.snowActive;

                // Ajoute ou retire la classe "rainy" pour le changement de fond
                document.body.classList.toggle('rainy', this.snowActive);

                if (this.snowActive) {
                    this.init(100);
                } else {
                    // Supprime tous les flocons de neige existants si la neige est désactivée
                    for (var i = 0, c = this.flakes.length; i < c; i++) {
                        document.body.removeChild(this.flakes[i].html);
                    }
                    this.flakes = [];
                }
            },
        };

        window.addEventListener('keydown', function (event) {
            if (event.key === 'q' && event.ctrlKey) {
                snow.toggleSnow();
            }
        });

        $(document).ready(function () {
            $('.accept-cookies-btn').on('click', function () {
                $('.cookie-container').addClass('hide');
                // Ici, vous pouvez aussi stocker un cookie pour indiquer que l'utilisateur a accepté les cookies
            });
        });

    </script>
</head>
<header
    class="entete flex flex-col sm:flex-row justify-center items-center p-1 sm:p-8 md:p-16 lg:p-20 xl:p-24 bg-cover bg-center h-300 sm:h-200 md:h-250 lg:h-300 xl:h-500">
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
                    <div class=" rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                        <div class="superposition-simple  "><a href="accueil.php">
                                <div class="texte-normal ">
                                    <div class="texte-original ">Accueil</div>
                                </div>
                                <div class="texte-hover "><img decoding="async" class="image-originale "
                                        src="Images/feuille.png" />
                                    <div class="texte-original">Accueil</div>
                                </div>
                            </a></div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class=" rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                        <div class="superposition-simple "><a href="blog.php">
                                <div class="texte-normal ">
                                    <div class="texte-original">Blog</div>
                                </div>
                                <div class="texte-hover "><img decoding="async" class="image-originale "
                                        src="Images/nuage.png" />
                                    <div class="texte-original">Blog</div>
                                </div>
                            </a></div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class=" rounded-full w-full sm:w-20 h-20 text-center flex mb-2 sm:mb-0 sm:mr-2">
                        <div class="superposition-simple "><a href="quizz.php">
                                <div class="texte-normal ">
                                    <div class="texte-original">Quizz</div>
                                </div>
                                <div class="texte-hover "><img decoding="async" class="image-originale "
                                        src="Images/soleil.png" />
                                    <div class="texte-original">Quizz</div>
                                </div>
                            </a></div>
                    </div>
                </li>
                <?php if ($logged_in && $is_admin != 1): ?>

                    <li class="nav-item">
                        <div class=" rounded-full w-full sm:w-20 h-20 text-center flex">
                            <div class="superposition-simple "><a href="backuser.php">
                                    <div class="texte-normal ">
                                        <div class="texte-original">Carte</div>
                                    </div>
                                    <div class="texte-hover "><img decoding="async" class="image-originale "
                                            src="Images/feuillemorte.png" />
                                        <div class="texte-original">Carte</div>
                                    </div>
                                </a></div>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <div class=" rounded-full w-full sm:w-20 h-20 text-center flex">
                        <div class="superposition-simple "><a href="apropos.php">
                                <div class="texte-normal ">
                                    <div class="texte-original">Nous</div>
                                </div>
                                <div class="texte-hover "><img decoding="async" class="image-originale "
                                        src="Images/glace.png" />
                                    <div class="texte-original">Nous</div>
                                </div>
                            </a></div>
                    </div>
                </li>
                <?php if ($logged_in && $is_admin === 1): ?>

                    <li class="nav-item">
                        <div class=" rounded-full w-full sm:w-20 h-20 text-center flex">
                            <div class="superposition-simple "><a href="backend.php">
                                    <div class="texte-normal ">
                                        <div class="texte-original">Back</div>
                                    </div>
                                    <div class="texte-hover "><img decoding="async" class="image-originale "
                                            src="Images/feuillemorte.png" />
                                        <div class="texte-original">Back</div>
                                    </div>
                                </a></div>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Lien de connexion / déconnexion -->
    <a class="testa" href="<?php echo $logged_in ? 'logout.php' : 'login.php'; ?>"
        class="flex items-center mb-2 sm:mb-0 sm:mr-2">
        <img src="Images/logo.png" alt="logo" class="w-12 h-12 rounded-full ">
        <span class="hidden sm:inline-block ml-1 text-white rounded-full hover:inline-block">
            <?php if ($logged_in): ?>
                <?php echo $username; ?>
            <?php else: ?>
                Connexion
            <?php endif; ?>
        </span>
    </a>
</header>

<body>

</body>

</html>