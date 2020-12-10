<?php ob_start() ?>

<div class="container bg-custom">

    <h3 class="secondary-title text-center">Les derniers articles</h3>

    <div class="row">

    <?php foreach ($resultat as $tab){?>
        
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><rect width="100%" height="100%" fill="#55595c"/></svg>
                <div class="card-body card-style">
                <h4> <?= $tab['title']?></h4>
                <p class="card-text">
                    <?= $tab['chapo']?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn btn-sm btn-green" href= "/post?id=<?= $tab['id']?>">Lire l'article</a>  
                </div>
                </div>
            </div>
        </div>

    <?php }  ?>        
    </div>

    <hr class="col-md-12">

    <section class= contact-form >
        <h3 class="h3 mb-3 font-weight-normal text-center" id='contact-anchor'>Contactez-moi</h3>

        <div class="starter-template">


            <form method="POST" action="/contact">

                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="InputName">Vos noms/prénoms</label>
                        <input type="text" name="name" class="form-control" id="InputName" required>
                    </div>
                    </div>

                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="InputEmail">Votre E-mail</label>
                        <input type="email" name="email" class="form-control" id="InputEmail" required>
                    </div>
                    </div>

                    <div class="col-md-12">
                    <div class="form-group">
                        <label for="InputMessage">Votre message</label>
                        <textarea name="message" class="form-control" id="InputMessage" required></textarea>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="Check" required>
                        <label class="form-check-label" for="exampleCheck1">J'ai compris. En envoyant ce formulaire, j'autorise le destinataire à utiliser mes données personnelles pour me répondre. Mentions Légales *</label>
                    </div>
                    <button type="submit" class="btn btn-pink">Envoyer</button>
                    </div>

                </div>
            </form>
        </div>

    </section>

</div>

<?php $content = ob_get_clean();

require 'templateFrontend.php' ?>

