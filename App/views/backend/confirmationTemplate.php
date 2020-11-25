
<?php ob_start();?>

<div class="container">

<h1><?= $titleAction?></h1>

<!--<form action='/login/check' method='post'>-->
    
<p><?= $textConfirmation ?></p>
<a class="btn btn-sm btn-outline-secondary" href= "<?=$actionConfirmation?>">Retour</a>

</div>
<?php $content = ob_get_clean();

require('App/views/frontend/templateFrontend.php');?>