<div class="tm-container">
    <div class="tm-row pt-4">
        <div class="tm-col-left">
            <div class="tm-site-header media">
                <a href="index.php" title="Home page" >
                    <img src="assets/img/logogo.png" alt="">
                </a>
                <div class="media-body">
                    <h1 class="tm-sitename text-uppercase">Bucket List</h1>
                    <p class="tm-slogon">with Keanu Reeves</p>
                </div>
            </div>
        </div>
        <div class="tm-col-right">
            <nav class="navbar navbar-expand-lg" id="tm-main-nav">
                <button class="navbar-toggler toggler-example mr-0 ml-auto" type="button" data-toggle="collapse" data-target="#navbar-nav" aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fas fa-bars"></i></span>
                </button>
                <div class="collapse navbar-collapse tm-nav" id="navbar-nav">
                    <ul class="navbar-nav text-uppercase">
                        <?php
                        require_once("config/connection.php");
                        require_once("models/category/functions.php");
                        $meni = queryExecute(getMenu());
                        foreach ($meni as $m) : ?>
                            <?php if ($m->name == "ikonica") : ?>
                                <li class="nav-item text-center">
                                    <a href="<?= $m->path ?>" id="juzer">
                                        <i class="fas fa-user fa-2x mt-1"></i>
                                    </a>

                                    <div class="mt-2">
                                        <?php
                                                $submenu = getSubmenu($m->id_menu);
                                                foreach ($submenu as $sm) {
                                                    if ($sm->name == "log in") {
                                                        if (isset($_SESSION['user'])) continue;
                                                    }
                                                    if ($sm->name == "register") {
                                                        if (isset($_SESSION['user'])) continue;
                                                    }
                                                    if ($sm->name == "log out") {
                                                        if (!isset($_SESSION['user'])) continue;
                                                    }
                                                    if ($sm->name == "my bucket") {
                                                        if (!isset($_SESSION['user'])) continue;
                                                        elseif ($_SESSION['user']->role == 'admin') continue;
                                                    }
                                                    if ($sm->name == "admin panel") {
                                                        if (!isset($_SESSION['user'])) continue;
                                                        elseif ($_SESSION['user']->role == 'user') continue;
                                                    }
                                                    echo "<div><a href='$sm->path'> $sm->name</a></div>";
                                                }
                                                ?>
                                    </div>
                                </li>
                                <?php continue ?>
                            <?php endif ?>
                            <?php
                                if ($m->name == "list") {
                                    if (isset($_SESSION["user"]) && ($_SESSION['user']->role == 'admin')) continue;
                                } ?>
                            <li class="nav-item">
                                <a class="nav-link tm-nav-link" href="<?= $m->path; ?>"><?= $m->name; ?> <span class="sr-only">(current)</span></a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </nav>
        </div>
        <div>
            <input type="hidden" name="" id="idUser" value="<?php if (isset($_SESSION["user"])) echo $_SESSION["user"]->uid;
                                                            else echo "0"; ?>">
        </div>
    </div>