<?php ob_start();?>
  
<div class="container">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
        <form class="form-signin" method="POST" action="/connexion">
            <h1 class="h3 mb-3 font-weight-normal">Connectez-vous</h1>

            <label for="login" class="sr-only">Login</label>
            <input type="text" name="login" class="form-control" placeholder="login" required autofocus>

            <label for="inputPassword" class="sr-only">Mot de passe</label>
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>

        </form>
        </div>


        <div class="col-md-8 order-md-1">
        <h2 class="h3 mb-3 font-weight-normal">Créer un compte</h2>
        <form class="needs-validation" method="POST" action="/addUser">

        <?php if(!empty($errors)){ ?>
            <div class="alert alert-danger">
                <p>Le formulaire est incomplet. Merci de corriger les erreurs suivantes:</p>
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php } ?>
            
            <div class="mb-3">
            <label for="e_mail">Votre E mail</label>
            <input type="email" class="form-control" id="e_mail" name="e_mail" required>
            <div class="invalid-feedback">
            Le champ est requis.
            </div>
            </div>

            <div class="mb-3">
            <label for="login">Login</label>
            <div class="input-group">
                <input type="text" class="form-control" id="login" name="login" required>
                <div class="invalid-feedback">
                    Le champ est requis.
                </div>
            </div>
            </div>

            <div class="mb-3">
            <label for="password">Votre mot de passe</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="invalid-feedback">
                    Le champ est requis.
                </div>
            </div>
            </div>
        
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Enregistrer</button>
        </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="App/public/bootstrap-4.5.3/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="App/public/bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="form-validation.js"></script>
</div>

<?php $content = ob_get_clean();
require('templateFrontend.php');?>