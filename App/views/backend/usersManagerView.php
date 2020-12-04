<?php ob_start();
$leadTitle= 'Administration';
$leadText='gestion des utilisateurs';?>

<div class="container">

        <div class="row">
            <div class="col-md-12">
            <p class="lead text-muted">liste des utilisateurs<p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive-md">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Login</th>
                                <th scope="col">E-Mail</th>
                                <th scope="col">Rôle</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <?php foreach ($resultat as $tab){?>
                        <tbody>
                            <tr>
                                <td><?= htmlentities($tab['login'])?></td>
                                <td><?= htmlentities($tab['e_mail'])?></td>
                                <td><?= htmlentities($tab['role'])?></td>
                                <td>
                                    <a class="btn btn-danger" href= "/deleteUser?id=<?= $tab['id']?>" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur?')">Supprimer</a>
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