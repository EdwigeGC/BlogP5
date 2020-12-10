<?php ob_start()?>

<div class="container">

    <?php if(empty($errors) && isset($errors)){?>
    <div class="alert alert-success">
        <p>L'article a bien été ajouté</p>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-12">
            <a href="/addPostForm" class="btn btn-green">Ajouter un article</a>
        </div>
        <h3>liste des articles<h3>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive-md">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id de l'article</th>
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
                            <td><?= htmlentities($tab['id']) ?></td>
                            <td><?= htmlentities($tab['date']) ?></td>
                            <td><?= htmlentities($tab['title']) ?></td>
                            <td><?= htmlentities($tab['author']) ?></td>
                            <td><?= htmlentities($tab['published']) ?></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-green" href= "/modifyPost?id=<?= $tab['id']?>">Modifier</a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-pink" href= "/deletePost?id=<?= $tab['id']?>" onclick="return confirm('Voulez-vous vraiment supprimer cet article?')" >Supprimer</a>
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

require 'templateBackend.php' ?>
