<?php if ((isset($_SESSION['user']) && $_SESSION['user']->role == 'admin')) : ?>
    <div class="tm-row">
        <div class="tm-col-left"></div>
        <main class="tm-col-right tm-contact-main">
            <!-- Content -->
            <section class="tm-content tm-contact">
                <div class="tm-row d-flex justify-content-between">
                    <a href="#allcat" class="mb-4 tm-content-title h2 aktiviraj">Categories</a>
                    <a href="#newcat" class="text-light aktiviraj">New category</a>
                </div>
                <div class="mt-5">
                    <div id="allcat" class="table-responsive-sm table-responsive-md table-responsive-lg">
                        <table class="table table-sm table-dark table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2">All:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php require_once("models/category/functions.php");
                                    $categories = queryExecute(getCategories());
                                    foreach ($categories as $c) :
                                        ?>
                                    <tr>
                                        <td><?= $c->name ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm my-auto btn-secondary mt-4 dugmeRemoveCat" data-idcat="<?= $c->id_category ?>" name="">Remove</button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="newcat">
                        <form id="" action="models/category/insert.php" method="POST" onsubmit="return proveraNewCat()">
                            <div class="form-group mb-4">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required="" /><span></span>
                            </div>
                            <div class="text-right">
                                <button type="submit" id="dugmeCreateCat" name="dugmeCreateCat" class="btn btn-big btn-primary mt-3 ">Create</button>
                            </div>
                            <?php
                                if (isset($_SESSION["errors"])) {
                                    print_r($_SESSION["errors"]);
                                    unset($_SESSION["errors"]);
                                }
                                if (isset($_SESSION["success"])) {
                                    print_r($_SESSION["success"]);
                                }
                                ?>
                        </form>
                    </div>
                </div>
                <div id="poruka"></div>
            </section>
        </main>
    </div>
<?php else : header("Location:index.php?page=home"); ?>
<?php endif ?>