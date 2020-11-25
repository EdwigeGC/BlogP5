<?php ob_start();
$leadTitle= 'Modifier/Supprimer un article';
$leadText='';?>



<div class="container">

    <div class="row">
       
        <div class="col-md-12">
            <h1 class='title-post-details'></h1>
            <div class="card mb-4 shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em"> </text></svg>
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted"> <?= $tab['category']?></small>
                </div>
                <p>De , mis à jour le </p>
                <p class="card-text">
                <?= $tab['chapo']?></p>
                <p><?= $tab['content']?></p>
                </div>
                <div class="btn-group">
                    <a class="btn btn-sm btn-outline-secondary" href= "">Enregistrer l'article</a>
                      
                    </div>
       
            </div>
        </div>

           
    </div>
</div>

<?php $content = ob_get_clean();

require('templateBackend.php');?>