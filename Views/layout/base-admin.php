<!DOCTYPE html>

<html lang="fr">
    <?php include_once './Views/partials/head-admin.php' ?>

    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
                <a class="navbar-brand d-block px-3" href="/dashboard">My blog</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navRes" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navRes">
                    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                        <a class="nav-link" href="/dashboard">
                            <i class="fa fa-fw fa-dashboard"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="post">
                        <a class="nav-link" href="/creer-un-post">
                            <i class="fa fa-fw fa-area-chart"></i>
                            <span class="nav-link-text">Créer un post</span>
                        </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="postUpdate">
                        <a class="nav-link" href="/modifier-un-post">
                            <i class="fa fa-fw fa-table"></i>
                            <span class="nav-link-text">Modifier/supprimer</span>
                        </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                            <a class="nav-link" href="/logout">
                                <i class="fa fa-fw fa-wrench"></i>
                                <span class="nav-link-text">Logout</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav sidenav-toggler">
                        <li class="nav-item">
                        <a class="nav-link text-center" id="sidenavToggler">
                            <i class="fa fa-fw fa-angle-left"></i>
                        </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="content-wrapper">
                <div class="container-fluid">

                    <?= $baseAdmin ?>

                </div>
            </div>
    </body>
</html>