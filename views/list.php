<?php if (isset($_SESSION["user"]) && $_SESSION['user']->role == 'admin') : ?>
<?php header("Location:../index.php?page=home");?>
<?php else : ?>
<div class="tm-row">
    <div class="tm-col-left"></div>
    <main class="tm-col-right">
        <div id="filterisorteri" class="d-flex justify-content-between tm-content">
            <select name="" id="filter" class="text-primary">
                <option value="0">Choose category</option>
                <?php
                require_once("models/category/functions.php");
                $categories = queryExecute(getCategories());
                foreach ($categories as $c) :
                    ?>
                    <option value="<?= $c->id_category ?>"><?= $c->name ?></option>
                <?php endforeach ?>
            </select>
            <select name="" id="sort" class="text-primary">
                <option value="0">Sort by:</option>
                <option value="1">Name A-Z</option>
                <option value="2">Name Z-A</option>
            </select>
        </div>
        <section class="tm-content" id="liste">
            <?php
            require_once("models/list/functions.php");
            //zukupno
            $lists = getLists(0);
            foreach ($lists as $l) :
                ?>
                <div class="media my-3 mb-5 tm-service-media okreci">
                    <img src="assets/img/lists/<?= $l->src ?>" alt="<?= $l->alt ?>" class="tm-service-img">
                    <div class="media-body tm-service-text">
                        <h2 class="mt-5 tm-content-title"><?= $l->listName ?></h2>
                        <!-- ovde ce biti ukuono,uradjeno i dodaj -->
                        <?php if (!isset($_SESSION['user'])) : ?>
                            <p class="text-danger">Gotta login to have your bucket filled in!</p>
                        <?php else : ?>
                            <p>
                                <button type="button" class="btn btn-secondary mt-4 plavo dugmeBucket" data-idlist="<?= $l->id_list ?>" name="">Pick up!</button>
                                <i class="fas fa-plus fa-1x ml-5"></i> <span class="font-italic" ><?php $result=getAddedStatistics($l->id_list); if($result) echo $result->total; else echo 0;?> Added</span>
                                <i class="fas fa-check-square fa-1x ml-1 "></i> <span class="font-italic" ><?php $result=getDoneStatistics($l->id_list); if($result) echo $result->total; else echo 0;?> Done</span>
                            </p>
                        <?php endif ?>
                    </div>
                </div>
            <?php endforeach ?>

        </section>
        <nav aria-label="Page navigation example" class="d-flex justify-content-center">
            <ul class="pagination" id="paginacija">

            </ul>
        </nav>
        <div class="text-center mt-5">
            <form action="models/file/excel.php" method="post">
                <button type="submit" id="dugmeExcel" name="dugmeExcel" class="btn btn-big btn-primary">Get this in excel!</button>
            </form>
        </div>
        <div id="poruka"></div>
    </main>
</div>
<?php endif ?>