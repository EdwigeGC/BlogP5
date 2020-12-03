<?php 

use App\entity\Superglobals;

session_start();?>

<?php ob_start();?>

<div class="container">
    <div class="py-5 text-center">
        <h2><?=$subtitle?></h2>
    </div>

    <div class="row">

        <div class="col-md-12">
            <form class="needs-validation" method="POST" action="<?= $action ?>">
       
                <div class="col-md-12">
                        <input type="hidden" name="id" value="<?= $resultat['id']?>" required>
                        
                </div>

                <div class="row">

                    <div class="col-md-12">
                        <label for="e-mail">E-mail</label>
                        <input type="email" class="form-control" id="e-mail" name="e_mail" value="<?= $resultat['e_mail']?>" required>
                        <div class="invalid-feedback">
                            Le champ est requis.
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="login">Login</label>
                        <input type="text" class="form-control" id="login" name="login" value="<?=$resultat['login']?>" required>
                        <div class="invalid-feedback">
                            Le champ est requis.
                        </div>
                    </div>

                    <div class="col-md-12">
                    
                        <label for="password">Modifier le mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?=$resultat['password']?>"required>
                        <div class="invalid-feedback">
                            Le champ est requis.
                        </div>
                    </div>

                </div>

                <hr class="col-md-12">
                
                <button class="btn btn-primary btn-lg btn-block" type="submit">Enregistrer</button>

            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="form-validation.js"></script></body>


<?php $content = ob_get_clean();
if ($_SESSION['role'] == "administrateur"){
    require('templateBackend.php');
}
else {
    require('App/views/frontend/templateFrontend.php');
}?>

