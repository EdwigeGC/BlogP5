<?php 
session_start();?>

<?php ob_start();
$leadTitle= '';
$leadText='';?>

<div class="container">

<div class="row">
        <div class="col-lg-12">
            <p><a href="/listPosts">Retour à la liste des articles</a></p>
        </div>
    </div>

    <div class="row">
       
        <div class="col-md-12">
            <h1 class='title-post-details'><?= htmlspecialchars($resultat['title']) ?></h1>
            <div class="card mb-4 shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title> <?= htmlspecialchars($resultat['title']) ?></title><rect width="100%" height="100%" fill="#55595c"/></svg>
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted"> <?= htmlspecialchars($resultat['category'])?></small>
                </div>
                <p class="mini-text">Par <?= htmlspecialchars($resultat['author']) ?></p>
                <p class="mini-text">Mis à jour le <?= htmlspecialchars($resultat['date']) ?></p>

                <p class="justify-content"><?= htmlspecialchars($resultat['chapo']) ?></p>
                <p class="justify-content"><?= nl2br(htmlspecialchars($resultat['content'])) ?></p>
                </div>
       
            </div>
        </div>
     
    </div>

    <div class="row">

    <h3 id='comment-anchor'>Commentaires</h3>

    <?php foreach ($resultat['comments'] as $key){
        if ($key['status'] == "agreed"){?>
        
        <div class="col-md-12">
            <div class="card mb-4 shadow-sm">
                 <div class="card-body">
                    <p>De <?= htmlspecialchars($key['author'])?>, le <?= htmlspecialchars($key['comment_date_fr'])?></p>
                    <p class="card-text"><?= htmlspecialchars($key['message']) ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                    </div>
                </div>
            </div>
        </div>

    <?php }
    }  ?>

           
    </div>

    <section class= contact-form>
    <h4>Ecrivez un commentaire</h4>

    <?php if(isset($_SESSION['id'])){?>

    <div class="starter-template">
        <form method="POST" action="/addComment">

            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="post_id" value="<?= $resultat['id']?>" required>       
                </div>

                <div class="col-md-6">
                <div class="form-group">
                <label for="author"><?= $_SESSION['login']?></label>
                <input type="hidden" name="author" value="<?= htmlspecialchars($_SESSION['login']) ?>"/>
                </div>
                </div>

                <div class="col-md-12">
                <div class="form-group">
                    <label for="InputMessage">Votre commentaire</label>
                    <textarea name="message" class="form-control" id="InputMessage" required></textarea>
                </div>
            
                <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>

            </div>
        </form>
    </div>
    <?php } 
    
    else {?>
    <p>Pour écrire un commentaire vous devez être connecté(e).</p>
    <a href="/login">Se connecter</a>
    <?php }?>


</section>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="App/public/bootstrap-4.5.3/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="App/public/bootstrap-4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="form-validation.js"></script>

<?php $content = ob_get_clean();

require('templateFrontend.php');?>