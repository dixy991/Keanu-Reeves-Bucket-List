<?php if ((isset($_SESSION['user']) && $_SESSION['user']->role =='user')) : ?>
    <div class="tm-row">
        <div class="tm-col-left"></div>
        <main class="tm-col-right tm-contact-main" id="izaBucket">
            <!-- Content -->
            <section class="tm-content tm-contact">
                <div class="tm-row d-flex justify-content-between">
                    <h2 class="mb-4 tm-content-title">My bucket</h2>
                    <a href="index.php?page=create-goal">Create your own goal!</a>
                </div>
                <p class="mb-85 mt-3 font-italic">"You have to change your life if you’re not happy, and wake up if things aren’t going the way you want. -KR"</p>
                <div class="d-flex justify-content-around">
                    <a href="#todo" class="border px-5 py-3 aktiviraj todo">Active goals</a>
                    <a href="#done" class="border px-5 py-3 text-light aktiviraj done">Completed</a>
                </div>
                <div>
                    <div class="" id="todo">
                        <?php
                            require_once("models/bucket/functions.php");
                            //active goals
                            $agoals = getGoals($_SESSION["user"]->uid, 0);
                            ispisiGoals($agoals);
                            ?>
                    </div>
                    <div class="" id="done">
                        <?php
                            require_once("models/bucket/functions.php");
                            //completed goals
                            $cgoals = getGoals($_SESSION["user"]->uid, 1);
                            ispisiGoals($cgoals); ?>
                    </div>
                </div>
            </section>
        </main>
    </div>
<?php else : header("Location:index.php?page=home"); ?>
<?php endif ?>