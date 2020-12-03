
<?php ob_start();?>

<div class="container">

<h1><?= htmlspecialchars($titleAction) ?></h1>

<!--<form action='/login/check' method='post'>-->
    
<p><?= htmlspecialchars($textConfirmation) ?></p>
<a class="btn btn-sm btn-outline-secondary" href= "<?= htmlspecialchars($actionConfirmation) ?>">Retour</a>

</div>
<?php $content = ob_get_clean();

require 'App/views/frontend/templateFrontend.php'?>