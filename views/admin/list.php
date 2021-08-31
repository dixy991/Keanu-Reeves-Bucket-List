<?php if ((isset($_SESSION['user']) && $_SESSION['user']->role == 'admin')) : ?>
<div class="tm-row">
    <div class="tm-col-left"></div>
    <main class="tm-col-right tm-contact-main">
        <!-- Content -->
        <section class="tm-content tm-contact m-0">
            <div class="tm-row d-flex justify-content-between mb-5">
                <a href="#alllists" class="mb-4 tm-content-title h2 aktiviraj">Lists</a>
                <a href="#newlist" class="text-light aktiviraj">New list</a>
            </div>
            <div>
                <div id="alllists" class="table-responsive-sm table-responsive-md table-responsive-lg" >
                    <table class="table table-sm table-dark table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col" colspan="6">All:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Name:</td>
                                <td>Image:</td>
                                <td>Category:</td>
                                <td colspan="2">Change:</td>
                            </tr>
                            <?php require_once("models/list/functions.php");
                            $lists = queryExecute(getListsForAdmin());
                            foreach ($lists as $l) :
                                ?>
                                <tr>
                                    <td><?= $l->name ?></td>
                                    <td>
                                        <img src="assets/img/lists/<?= $l->src_small ?>" alt="<?= $l->alt ?>">
                                    </td>
                                    <td><?= $l->catName ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm my-auto btn-secondary mt-4 dugmeEditList" data-idlist="<?= $l->id_list ?>" name="">Edit</button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm my-auto btn-secondary mt-4 dugmeRemoveList" data-idlist="<?= $l->id_list ?>" name="">Remove</button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div id="newlist">
                    <form action="models/list/insert.php" method="post" enctype="multipart/form-data" onsubmit="return proveraCreate()">
                        <div class="form-group mb-4">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Type your goal here...">
                        </div>
                        <div class="form-group mb-4">
                            <select name="category" id="category" class="text-primary">
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
                </div>
                <div id="editlist">
                    <div class="d-flex justify-content-center mb-5" >
                        <img src="" alt=""  id="editImage">
                    </div>
                    <form action="models/list/update.php" id="editForm" enctype="multipart/form-data" method="post" onsubmit="return changeList()">
                        <input type="hidden" name="idList" id="idList">
                        <div class="form-group mb-4">
                            <input type="file" name="editPicture" id="">
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" name="editName" id="editName" class="form-control" placeholder="Name" required="" /><span></span>
                        </div>
                        <div class="form-group mb-4">
                            <select name="editCategory" id="editCategory" class="text-primary">
                                <?php
                                $categories = queryExecute(getCategories());
                                foreach ($categories as $c) :
                                    ?>
                                    <option value="<?= $c->id_category ?>"><?= $c->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group mb-4 mt-3 d-flex justify-content-between">
                            <button type="button" class="btn btn-sm my-auto btn-secondary mt-4 backArrow" data-back="list" name="">
                                <i class="fas fa-arrow-left mr-1"></i>Go back</button>
                            <button type="submit" class="btn btn-sm my-auto btn-secondary mt-4" id="changeList" name="changeList">Change</button>
                        </div>
                    </form>
                </div>
            </div>
            <div id="poruka"></div>
        </section>
    </main>
</div>
<?php else : header("Location:index.php?page=home"); ?>
<?php endif ?>