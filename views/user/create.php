<?php if ((isset($_SESSION['user']) && $_SESSION['user']->role =='user')) : ?>
    <div class="tm-row">
        <div class="tm-col-left"></div>
        <main class="tm-col-right tm-contact-main">
            <!-- Content -->
            <section class="tm-content tm-contact" id="izaBucket" >
                <h2 class="mb-4 tm-content-title">Create a goal</h2>
                <p class="mb-85 font-italic">"The person who was holding me back from my happiness was me.-KR"</p>
                <form action="models/list/insert.php" method="post" enctype="multipart/form-data" onsubmit="return proveraCreate()">
                    <div class="form-group mb-4">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Type your goal here...">
                    </div>
                    <div class="form-group mb-4">
                        <select name="category" id="category" class="text-primary" >
                            <option value="0">Choose category</option>
                            <?php
                                require_once("models/category/functions.php");
                                $categories = queryExecute(getCategories());
                                foreach ($categories as $c) :
                                    ?>
                                <option value="<?= $c->id_category ?>"><?= $c->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group mb-5">
                        <input type="file" name="picture" id="picture" class=""><span></span>
                    </div>
                    <div class="text-right">
                        <button type="submit" id="dugmeCreate" name="dugmeCreate" class="btn btn-big btn-primary">Create</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
<?php else : header("Location:index.php?page=home"); ?>
<?php endif ?>