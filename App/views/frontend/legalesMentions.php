<?php ob_start() ?>

<div class="container">
    <p>mentions légales</p>

</div>
<?php $content = ob_get_clean();

require 'templateFrontend.php' ?>