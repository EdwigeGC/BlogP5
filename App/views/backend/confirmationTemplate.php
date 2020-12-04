
<?php ob_start();?>

<div class="container">

<h1><?= htmlentities($titleAction) ?></h1>

<!--<form action='/login/check' method='post'>-->
    
<p><?= htmlentities($textConfirmation) ?></p>
<a class="btn btn-sm btn-outline-secondary" href= "<?= htmlentities($actionConfirmation) ?>">Retour</a>

</div>
<?php $content = ob_get_clean();

require 'App/views/frontend/templateFrontend.php'?>