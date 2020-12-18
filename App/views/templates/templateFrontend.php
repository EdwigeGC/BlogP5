<?php
session_start(); ?>

<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="App/public/bootstrap-4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="App/public/bootstrap-4.5.3/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="App/public/bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="App/public/Bootstrap-4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="App/public/style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4281e8c561.js" crossorigin="anonymous"></script>

    <title>Blog</title>

</head>

<body>

    <header class="navbar navbar-expand-lg navbar-expand-xl navbar-dark bg-dark navbar-style">

        <a class="navbar-brand main-title-style navbar-font-color" href="/home">EG-development</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample05">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link  navbar-font-color" href="/home">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navbar-font-color" href="/listPosts">Tous les articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navbar-font-color" href="/home#contact-anchor">Contact</a>
                </li>
            </ul>

            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link pl-2 pr-1 mx-1 py-3 my-n2" href="https://www.linkedin.com/in/edwige-genty-a2748b144/" target="_blank" rel="noopener" aria-label="linkedIn"><i class="fab fa-linkedin fa-2x"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-2 pr-1 mx-1 py-3 my-n2" href="https://twitter.com/EdwigeGenty" target="_blank" rel="noopener" aria-label="twitter"><i class="fab fa-twitter fa-2x"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-2 pr-1 mx-1 py-3 my-n2" href="https://github.com/EdwigeGC" target="_blank" rel="noopener" aria-label="github"><i class="fab fa-github fa-2x"></i></a>
                </li>
            </ul>


            <?php if (isset($_SESSION['login'])) { ?>
                <a class="p-2 session-text" href="/userForm?id=<?= $_SESSION['id'] ?>">Bienvenue <?= htmlentities($_SESSION['login']) ?></a>

                <a class="btn btn-pink" href="/logOut">Déconnexion</a>
            <?php } else { ?>
                <a class="btn btn-pink" href="/login">Connexion</a>
            <?php } ?>
        </div>
        </div>
    </header>

    <main role="main">

        <section class="jumbotron text-center">

            <div class="container rounded">
                <h1 class="main-title-style">Edwige GENTY</h1>
                <p class="lead">Développeur PHP<p>
                        <a href="/home#contact-anchor" class="btn my-2 btn-contact">Me contacter</a>
                        <a href="App/public/PDF/CV_Edwige_Genty.pdf" target="_blank" class="btn my-2 btn-download">Télécharger mon CV</a>
                    </p>
            </div>
        </section>

        <div class="album py-5 bg-custom">
            <?= ($content) ?>
        </div>

    </main>


    <footer>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand main-title-style" href="/home">EG-development</a>
            <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/listPosts">Les articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/home#contact-anchor">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/legalesMentions">Mentions légales</a>
                    </li>
                </ul>
            </div>
        </nav>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>