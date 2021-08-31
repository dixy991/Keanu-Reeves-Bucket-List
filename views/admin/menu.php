<?php if ((isset($_SESSION['user']) && $_SESSION['user']->role == 'admin')) : ?>
<div class="tm-row">
    <div class="tm-col-left"></div>
    <main class="tm-col-right tm-contact-main">
        <!-- Content -->
        <section class="tm-content tm-contact m-0 table-responsive-sm table-responsive-md table-responsive-lg">
            <div class="tm-row d-flex justify-content-between">
                <a href="#allmenu" class="mb-4 tm-content-title h2 aktiviraj">Menu</a>
                <a href="#newmenu" class="text-light aktiviraj">Add new</a>
            </div>
            <div id="allmenu">
                <table class="table table-sm table-dark table-hover text-center" id="all-menu">
                    <thead>
                        <tr>
                            <th scope="col" colspan="6">All:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>Name:</td>
                        <td>Parent:</td>
                        <td>Position:</td>
                        <td>Change:</td>
                        <?php require_once("models/list/functions.php");
                        $menu = queryExecute(getWholeMenu());
                        foreach ($menu as $m) :
                            ?>
                            <tr>
                                <td><?= $m->name ?></td>
                                <td><?= $m->parent ?></td>
                                <td><?= $m->position ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm my-auto btn-secondary mt-4 dugmeRemoveMenu" data-idmenu="<?= $m->id_menu ?>" name="">Remove</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div id="newmenu">
                <form id="" action="models/list/insert.php" method="POST" onsubmit="return proveraNewMenu()">
                    <div class="form-group mb-4">
                        <input type="text" name="nameMenu" id="nameMenu" class="form-control" placeholder="Name" /><span></span>
                    </div>
                    <div class="form-group mb-4">
                        Path:
                        <input type="text" name="namePath" id="namePath" class="form-control" placeholder="Path" value="index.php?page=" /><span></span>
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="numParent" id="numParent" class="form-control" placeholder="Parent number" /><span></span>
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="numPosition" id="numPosition" class="form-control" placeholder="Position number"  /><span></span>
                    </div>
                    <div class="text-right">
                        <button type="submit" id="dugmeCreateMenu" name="dugmeCreateMenu" class="btn btn-big btn-primary mt-3 ">Create</button>
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
            <div id="poruka"></div>
        </section>
    </main>
</div>
<?php else : header("Location:index.php?page=home"); ?>
<?php endif ?>