<?php 
use App\core\View;
ob_start(); ?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h5>Modifier/supprimer des posts</h5>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                    <th scope="col">titre</th>
                    <th scope="col">preview</th>
                    <th scope="col">date création</th>
                    <th scope="col">dernière modification</th>
                    <th scope="col">modifier</th>
                    <th scope="col">supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($posts as $post) :  ?>
                        <tr>
                            <td><?= $post->getTitle() ?></td>
                            <td><?= substr($post->getChapo(), 0, 50) ?>...</td>
                            <td><?= (new \Datetime($post->getCreatedAt()))->format('d/m/Y') ?></td>
                            <td><?= $post->getUpdatedAt() != null ? (new \Datetime($post->getUpdatedAt()))->format('d/m/Y') : 'aucune' ?></td>
                            <td>
                                <a href="#">
                                    <img src="https://cdn0.iconfinder.com/data/icons/phosphor-light-vol-3/256/pencil-line-light-1024.png" alt="" width="40" height="40"/>
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <img src="https://cdn3.iconfinder.com/data/icons/font-awesome-solid/512/trash-1024.png" alt="" width="40" height="40">
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $baseAdmin = ob_get_clean(); ?>
<?php require('./Views/layout/base-admin.php'); ?>