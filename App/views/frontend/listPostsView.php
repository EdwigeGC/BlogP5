<?php ob_start() ?>


<div class="container">

    <h2 class="page-title">Liste des articles</h2>

    <div class="row">

        <?php foreach ($resultat as $tab) { ?>

            <div class="col-md-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h3><?= $tab['title'] ?></h3>
                        <p class="card-text">
                            <?= $tab['chapo'] ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">dernière modification: <?= $tab['date'] ?>
                            </small>
                            <a class="btn btn-sm btn-green" href="/post?id=<?= htmlentities($tab['id']) ?>">Lire l'article</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php }  ?>
    </div>
</div>

<?php $content = ob_get_clean();

require 'templateFrontend.php' ?>