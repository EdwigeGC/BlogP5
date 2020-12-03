<?php ob_start();
$leadTitle= '';
$leadText='Mention légales';?>

<div class="container">
    <p>mentions légales</p>

</div>
<?php $content = ob_get_clean();

require('templateFrontend.php');?>