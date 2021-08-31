<?php if ((isset($_SESSION['user']) && $_SESSION['user']->role == 'admin')) : ?>
<div class="tm-row">
    <div class="tm-col-left"></div>
    <main class="tm-col-right tm-contact-main">
        <!-- Content -->
        <section class="tm-content tm-contact table-responsive-sm table-responsive-md table-responsive-lg">
            <h2 class="mb-5 tm-content-title">Admin panel</h2>
            <table class="table table-sm table-dark table-hover text-center">
                <thead>
                    <tr>
                        <!-- <th scope="col">#</th> -->
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- <th scope="row">3</th> -->
                        <td><a href="index.php?page=admin-menu">menu</a></td>
                    </tr>
                    <tr>
                        <!-- <th scope="row">1</th> -->
                        <td><a href="index.php?page=admin-category">categories</a></td>
                    </tr>
                    <tr>
                        <!-- <th scope="row">2</th> -->
                        <td><a href="index.php?page=admin-user">users</a></td>
                    </tr>
                    <tr>
                        <!-- <th scope="row">3</th> -->
                        <td><a href="index.php?page=admin-list">lists</a></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-sm table-dark table-hover text-center my-5">
                <thead>
                    <tr>
                        <!-- <th scope="col">#</th> -->
                        <th scope="col" colspan="2">Visits</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Page:</td>
                        <td>Per%:</td>
                    </tr>
                    <?php
                    require_once("models/visit/functions.php");
                    $visita = count_visits();
                    // var_dump($visita);
                    foreach ($visita as $i => $v) :
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $v ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <table class="table table-sm table-dark table-hover text-center">
                <thead>
                    <tr>
                        <!-- <th scope="col">#</th> -->
                        <th scope="col" colspan="2">Current number of logged in:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= count_current_logged_in()->total; ?></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</div>
<?php else : header("Location:index.php?page=home"); ?>
<?php endif ?>