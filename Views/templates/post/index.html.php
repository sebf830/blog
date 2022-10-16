<?php  
use App\core\View;
use App\Repository\TagRepository;
use App\Repository\PostsTagsRepository;
ob_start(); ?>

<div class="container py-4">
    <div class="row" style="margin-top:3em">
        <?php foreach($posts as $post) : ?>
            <div class="col-md-6 mt-3">
                <div class="p-4 text-bg-light rounded-3 border shadow">
                    <h3><?= $post->getTitle() ?></h3>
                        <div class="post-tag mb-4">
                            <?php foreach ((new PostsTagsRepository)->findBy(['post' => $post->getId()]) as $tag) : ?>
                                    <span><?= (new TagRepository)->findOneBy(['id' => $tag->getId()])[0]->getTitle() ?></span>
                            <?php endforeach ?>
                        </div>
                    <p><?= substr($post->getContent(), 0, 100) ?>...</p>
                    <a class="btn btn-outline-dark" type="button" href="/post/lire/<?= $post->getSlug() ?>">Lire l'article</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?php $base = ob_get_clean(); ?>
<?php require('./Views/layout/base.php'); ?>