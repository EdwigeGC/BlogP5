<?php ob_start();?>

<div class="container">
    <div class="py-5 text-center">
        <h2><?=$subtitle?></h2>
    </div>

    <div class="row">

        <div class="col-md-12">
            <form class="needs-validation" method="POST" action="<?= $action ?>" novalidate>
       
                <div class="col-md-12">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($resultat['id'])?>" required>
                        
                </div>

                <div class="col-md-12">
                    <label for="title">Titre de l'article</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($resultat['title']) ?>" required>
                    </div>
                </div>
        
                <div class="col-md-12">
                    <label for="author">Nom de l'auteur</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="author" name="author" value="<?= htmlspecialchars($resultat['author']) ?>" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="chapo">Chapô</label>
                    <textarea class="form-control medium-content" id="chapo" name="chapo" required> <?= htmlspecialchars($resultat['chapo']) ?></textarea>
                </div>

                <div class="col-md-12">
                    <label for="content">Contenu</label>
                    <textarea class="form-control big-content" id="content" name="content" required><?= htmlspecialchars($resultat['content']) ?></textarea>
                </div>

                <hr class="col-md-12">

                <div class="row">
                    <div class="col-md-6">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="published" name="published" value=1 required
                             <?php if (isset($resultat['published'])){
                                        if ($resultat['published']==1){?>
                                        checked
                                        <?php }
                                        }?>
                                        )>
                            <label class="custom-control-label" for="published">Publier l'article</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="no-published" name="published" value=0 required
                            <?php if (isset($resultat['published'])){
                                        if ($resultat['published']==0){?>
                                        checked
                                        <?php }
                                        }?>
                                        )>>
                            <label class="custom-control-label" for="no-published">Enregistrer sans publier</label>
                        </div>
                    </div>
                </div>

                <hr class="col-md-12">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Enregistrer</button>
            </form>
        </div>
    </div>

    <div class="row">
    <?php foreach ($resultat['comments'] as $key){?>  
        <div class="col-md-12">
            <div class="card mb-4 shadow-sm">
                 <div class="card-body">
                    <p>De <?= htmlspecialchars($key['author'])?>, le <?= $key['comment_date_fr']?></p>
                        <?php if ($key['status']='waiting'){?>
                            <small class="text-muted">en attente de validation</small>
                        <?php }?>
                        <?php if($key['status']='agreed'){?>
                                <small class="text-muted">publié</small>
                        <?php }?>

                    <p class="card-text"><?= nl2br(htmlspecialchars($key['message'])) ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                    </div>
                </div>
                <div class="btn-group">
                    <a class="btn btn-sm btn-outline-secondary" href= "/deleteComment?id=<?= $key['id']?>">Supprimer le commentaire</a>
                </div>
            </div>
            
        </div>

    <?php }  ?>

           
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="pp/public/bootstrap-4.5.3/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="App/public/bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="App/public/form-validation.js"></script></body>


<?php $content = ob_get_clean();
require 'templateBackend.php';?>