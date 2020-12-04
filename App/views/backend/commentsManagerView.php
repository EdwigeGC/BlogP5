<?php ob_start();
$leadTitle= 'Administration';
$leadText='gestion des commentaires';?>

<div class="container">

        <div class="row">
            <div class="col-md-12">
            <p class="lead text-muted">liste des commentaires en attente de validation<p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive-md">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Auteur</th>
                                <th scope="col">Date</th>
                                <th scope="col">Message</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <?php foreach ($resultat as $tab){?>
                        <tbody>
                            <tr>
                                <td><?= htmlentities($tab['author'])?></td>
                                <td><?= htmlentities($tab['comment_date_fr'])?></td>
                                <td><?= htmlentities($tab['message'])?></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-success" href= "/publishComment?id=<?= $tab['id']?>">Publier</a>                                    
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-danger" href= "/deleteComment?id=<?= $tab['id']?>" onclick="return confirm('Voulez-vous vraiment supprimer ce commentaire?')">Supprimer</a>
                                    </div>
                                </td>
                            </tr>
                        <tbody>
                        <?php }  ?>
                    </table>
                </div>
            </div>
        </div>

    </div>

<?php $content = ob_get_clean();

require('templateBackend.php');?>