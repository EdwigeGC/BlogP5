<?php ob_start();
$leadTitle= '';
$leadText='Oups';?>

<div class="container">

<p>Page introuvable ...</p>

</div>

<?php $content = ob_get_clean();

require 'templateFrontend.php'?>