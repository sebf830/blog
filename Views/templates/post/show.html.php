<?php  
use App\Repository\TagRepository;
use App\Repository\PostsTagsRepository;

ob_start(); ?>


<div class="bg-secondary m-0 p-0 titlePostShowBox pt-5" style="height:20em;width:100%">
    <h4 class="mt-5 text-center text-white text-center titlePostShow"><?= $post->getTitle() ?></h4>
</div>
<div class="container py-4">
    <div class="row" style="margin-top:3em">
        <div class="col-md-8 mx-auto text-left">
            <small><?= (new \DateTime($post->getCreatedAt()))->format('d/m/Y') ?> à </small>
            <small><?= (new \DateTime($post->getCreatedAt()))->format('H:i') ?></small>

            <div class="post-tag mb-4 mt-2">
                <?php foreach ((new PostsTagsRepository)->findBy(['post' => $post->getId()]) as $tag) : ?>
                        <span><?= (new TagRepository)->findOneBy(['id' => $tag->getId()])[0]->getTitle() ?></span>
                <?php endforeach ?>
            </div>

            <p class="my-5"><?= $post->getContent() ?></p>

            <div class="authorPost d-flex align-items-center">
                <span class="authorAvatar bg-secondary d-block">
                    <?= ucfirst(substr($author->getFirstname(), 0, 1)) . ucfirst(substr($author->getLastname(), 0, 1)) ?>
                </span>
                <span class="authorName d-block mx-1">
                    <span class="fs-4"><?= ucfirst($author->getFirstname()) .' '. ucfirst($author->getLastname()) ?></span><br>
                    <small>Développeur PHP/Symfony depuis 2021, passionné par le web</small>
                </span>
            </div>
        </div>
    </div>
</div>



<?php $base = ob_get_clean(); ?>
<?php require('./Views/layout/base.php'); ?>
