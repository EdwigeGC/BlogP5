<?php ob_start(); ?>

<div class="container">
    <div class="py-5 text-center">
        <h2><?= $subtitle ?></h2>
    </div>

    <div class="row">

        <div class="col-md-12">
            <form class="needs-validation" method="POST" action="<?= $action ?>" novalidate>

                <div class="col-md-12">
                    <input type="hidden" name="id" value="<?= htmlentities($resultat['id']) ?>" required>
                </div>

                <div class="col-md-12">
                    <label for="title">Titre de l'article</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="title" name="title" value="<?= htmlentities($resultat['title']) ?>" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="author">Nom de l'auteur</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="author" name="author" value="<?= htmlentities($resultat['author']) ?>" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="chapo">Chapô</label>
                    <textarea class="form-control medium-content" id="chapo" name="chapo" required> <?= htmlentities($resultat['chapo']) ?></textarea>
                </div>

                <div class="col-md-12">
                    <label for="content">Contenu</label>
                    <textarea class="form-control big-content" id="content" name="content" required><?= htmlentities($resultat['content']) ?></textarea>
                </div>

                <hr class="col-md-12">

                <div class="row">
                    <div class="col-md-6">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="published" name="published" value="Publié" required <?php if (isset($resultat['published'])) {
                                                                                                                                            if ($resultat['published'] == "Publié") { ?> checked <?php }
                                                                                                                                        } ?>>
                            <label class="custom-control-label" for="published">Publier l'article</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="no-published" name="published" value="Non publié" required <?php if (isset($resultat['published'])) {
                                                                                                                                                if ($resultat['published'] == "Non publié") { ?> checked <?php }
                                                                                                                                            } ?>>
                            <label class="custom-control-label" for="no-published">Enregistrer sans publier</label>
                        </div>
                    </div>
                </div>

                <hr class="col-md-12">
                <button class="btn btn-pink btn-lg btn-block" type="submit">Enregistrer</button>
            </form>
        </div>
    </div>

    <div class="row">
        <h3>Commentaires publiés</h3>
        <?php foreach ($resultat['comment'] as $key => $value) { ?>
            <div class="col-md-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <p>De <?= htmlentities($value['author']) ?>, le <?= $value['comment_date_fr'] ?></p>
                        <p class="card-text"><?= nl2br(htmlentities($value['message'])) ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                        </div>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-sm btn-danger" href="/deleteComment?id=<?= $value['id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cet article?')">Supprimer le commentaire</a>
                    </div>
                </div>
            </div>
        <?php }  ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>
    window.jQuery || document.write('<script src="pp/public/bootstrap-4.5.3/js/vendor/jquery.slim.min.js"><\/script>')
</script>
<script src="App/public/bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="App/public/form-validation.js"></script>
</body>


<?php $content = ob_get_clean();
require 'templateBackend.php'; ?>