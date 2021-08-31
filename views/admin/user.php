<?php if ((isset($_SESSION['user']) && $_SESSION['user']->role == 'admin')) : ?>
<div class="tm-row">
    <div class="tm-col-left"></div>
    <main class="tm-col-right tm-contact-main p-0">
        <!-- Content -->
        <section class="tm-content tm-contact m-0 table-responsive-sm table-responsive-md table-responsive-lg">
                <h2 class="mb-4 tm-content-title">Users</h2>
            <table class="table table-sm table-dark table-hover text-center" id="user-table">
                <thead>
                    <tr>
                        <th scope="col" colspan="6">All:</th>
                    </tr>
                </thead>
                <tbody>
                    <td>Username:</td>
                    <td>Email:</td>
                    <td>Role:</td>
                    <td colspan="2">Change:</td>
                    <?php require_once("models/user/functions.php");
                    $users = queryExecute(getUsers());
                    foreach ($users as $u) :
                        ?>
                        <tr>
                            <td><?= $u->username ?></td>
                            <td><?= $u->email ?></td>
                            <td><?= $u->role ?></td>
                            <td>
                                <button type="button" class="btn btn-sm my-auto btn-secondary mt-4 dugmeEditUser" data-iduser="<?= $u->id_user ?>" name="">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm my-auto btn-secondary mt-4 dugmeRemoveUser" data-iduser="<?= $u->id_user ?>" name="">Remove</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <form action="" id="user-form">
                <input type="hidden" name="idUser" id="idUser" >
                <div class="form-group mb-4">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required="" /><span></span>
                </div>
                <div class="form-group mb-4">
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" required="" /><span></span>
                </div>
                <div class="form-group mb-4">
                    Active:
                    <input type="radio" name="active" id="active" required="" value="1" />Yes<span></span>
                    <input type="radio" name="active" id="non-active" required="" value="0" />Noupe<span></span>
                </div>
                <div class="form-group mb-4">
                    <select name="role" id="role" class="text-primary">
                        <?php
                        require_once("models/user/functions.php");
                        $roles = queryExecute(getRoles());
                        foreach ($roles as $r) :
                            ?>
                            <option value="<?= $r->id_role ?>"><?= $r->name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group mb-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-sm my-auto btn-secondary mt-4 backArrow" data-back="user" name="">
                    <i class="fas fa-arrow-left mr-1"></i>Go back</button>
                    <button type="button" class="btn btn-sm my-auto btn-secondary mt-4" id="changeUser" name="">Change</button>
                </div>
            </form>
            <div id="poruka"></div>
        </section>
    </main>
</div>
<?php else : header("Location:index.php?page=home"); ?>
<?php endif ?>