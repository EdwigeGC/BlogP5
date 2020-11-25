<?php ob_start();
$leadTitle='Les articles';
$leadText=''?>


<div class="container">

    <div class="row">

    <?php foreach ($resultat as $tab){?>
        
        <div class="col-md-12">
            <div class="card mb-4 shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title> <?= $tab['title']?></title><rect width="100%" height="100%" fill="#55595c"/></svg>
                <div class="card-body">
                <h2><?= $tab['title']?></h2>
                <p class="card-text">
                    <?= $tab['chapo']?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">dernière modification: 
                        <?php if (isset($tab['modification_date_fr'])){
                            echo $tab['modification_date_fr'];
                        }
                        else {
                            echo $tab['creation_date_fr'];

                        } ?>
                    </small>
                    <div class="btn-group">
                        <a class="btn btn-sm btn-outline-secondary" href= "/post?id=<?= $tab['id']?>">Lire l'article</a>
                      
                    </div>
                </div>
                </div>
            </div>
        </div>

        <?php }  ?>

           
    </div>
</div>

<?php $content = ob_get_clean();

require('templateFrontend.php');?>