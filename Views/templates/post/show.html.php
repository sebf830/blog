<?php  
use App\core\View;
use App\Repository\TagRepository;
use App\Repository\PostsTagsRepository;

ob_start(); ?>

<?php if(isset($_SESSION['flash'])) : ?>
    <p class=" alert alert-success m-0 text-center" ><?= $_SESSION['flash'] ?></p>
<?php endif ?>
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
    <hr class="px-5 mt-5">
    <div id="ankle-form-comment"></div>
    <div class="row mb-5">
        <div class="col-md-6 mx-auto mt-5">
            <?php if (!empty($validation)) : ?>
                <div class="p-2 m-3" style="background:#ffb3b3;color:#cc0000;border:1px solid grey">
                    <?php foreach ($validation as $error) : ?>
                        <p> <?= $error ?> </p>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <h5>Poster un commentaire</h5>
            <?php View::renderForm("form",  $form) ?>
                <button type="submit" class="btn btn-secondary">envoyer</button>
            <?php View::endForm() ?> 
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-8 col-md-8 col-sm-12 mx-auto text-left">
            <?php foreach($comments as $comment) : ?>
                <div class="row mb-3">
                    <div class="authorPost d-flex align-items-center">
                        <span class="authorAvatar bg-secondary d-block">
                            <?= ucfirst(substr($comment['firstname'], 0, 1)) . ucfirst(substr($comment['lastname'], 0, 1)) ?>
                        </span>
                        <span class="authorName d-block mx-4">
                            <span class="fs-4"><?= ucfirst($comment['firstname']) .' '. ucfirst($comment['lastname']) ?></span>&nbsp;&nbsp;
                            <small class="text-muted" style="font-size:13px;"><?= $comment['createdAt'] ?></small>
                            <p><?= $comment['content'] ?></p>
                        </span>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

</div>
<?php if(isset($_SESSION['flash'])) : ?>
    <?php unset($_SESSION['flash']) ?>
<?php endif ?>


<?php $base = ob_get_clean(); ?>
<?php require('./Views/layout/base.php'); ?>
