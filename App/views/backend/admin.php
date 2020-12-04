<?php ob_start();
$leadTitle= 'Administration';
$leadText='liste des articles';?>

<div class="container">

    <div class="row">
        <div class="col-md-12">
        <a href="/addPostForm" class="btn btn-outline-primary">Ajouter un article</a>
        <p class="lead text-muted">liste des articles<p>
        </div>
    </div>

    
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive-md">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Dernière modification</th>
                                <th scope="col">Titre</th>
                                <th scope="col">Author</th>
                                <th scope="col">Publication</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <?php foreach ($resultat as $tab){?>
                        <tbody>
                            <tr>
                                <td><?= htmlentities($tab['date']) ?></td>
                                <td><?= htmlentities($tab['title']) ?></td>
                                <td><?= htmlentities($tab['author']) ?></td>
                                <?php if($tab['published'] == 1)
                                {?>
                                <td>Publié</td>
                                <?php } 
                                else
                                {?>
                                 <td>Non publié</td>
                                <?php } ?>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-secondary" href= "/modifyPost?id=<?= $tab['id']?>">Modifier</a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-danger" href= "/deletePost?id=<?= $tab['id']?>" onclick="return confirm('Voulez-vous vraiment supprimer cet article?')" >Supprimer</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <?php }  ?>
                    </table>
                </div>
            </div>
        </div>
    
   
</div>

<?php $content = ob_get_clean();

require('templateBackend.php');?>
