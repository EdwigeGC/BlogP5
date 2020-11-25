<?php 
session_start();?>

<!doctype html>
<html lang="en">


  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="App/public/bootstrap-4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="App/public/bootstrap-4.5.3/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="App/public/bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="App/public/style.css" rel="stylesheet">
    <title>Administration - EG blog</title>

  </head>

  <body>

    <header>
    
        <nav class="navbar navbar-expand-lg navbar-expand-xl navbar-dark bg-dark">  
            <a class="navbar-brand" href="/home">EG-development</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample05">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin">Liste des articles<span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/commentsManagerView">Gestion des commentaires<span class="sr-only"></span></a>
                    </li>
                </ul>

                <nav class="my-2 my-md-0 mr-md-3">
                        <a class="p-2 text-light" href="/userForm?id=<?= $_SESSION['id']?>">Bienvenue <?= $_SESSION['login'] ?></a>
                        <a class="btn btn-outline-primary" href="/logOut">Déconnexion</a>
                </nav>
            
                
            </div>  
        </nav>

    </header>

    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1><?= $leadTitle ?></h1>
                <p class="lead text-muted"><?= $leadText ?></p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <?= $content ?>
        </div>

    </main>

    <footer class="text-muted">
        <div class="container">
            <p class="float-right">
            <a href="#">Haut de page</a>
            </p>
        </div>
    </footer>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</html>

