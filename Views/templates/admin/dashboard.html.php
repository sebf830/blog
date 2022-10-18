<?php ob_start(); ?>


      <div class="row">
        <h5 class="my-5">My dashboard</h5>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                    <i class="fa fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5"><?= $countPosts ?> blog-posts</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                    <i class="fa fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5"><?= $countComments ?> commentaires</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                    <i class="fa fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5"><?= count($users) ?> utilisateur(s) inscrit(s)</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                    <i class="fa fa-fw fa-comments"></i>
                    </div>
                    <div class="mr-5">26 New Messages!</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h5></h5>

    </div>

<?php $baseAdmin = ob_get_clean(); ?>
<?php require('./Views/layout/base-admin.php'); ?>