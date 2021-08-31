<div class="tm-row">
    <div class="tm-col-left"></div>
    <main class="tm-col-right tm-contact-main">
        <!-- Content -->
        <section class="tm-content tm-contact">
            <h2 class="mb-4 tm-content-title">Log in</h2>
            <p class="mb-5 font-italic">"Grief changes shape but it never ends.-KR"</p>
            <form id="" action="models/user/login.php" method="POST" onsubmit="return proveraLogin()">
                <div class="form-group mb-4">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="" /><span></span>
                </div>
                <div class="form-group mb-5">
                    <input type="password" name="password" id="password" class="form-control" id="" placeholder="Password" required=""><span></span>
                </div>
                <div class="text-right">
                    <button type="submit" id="dugmeLogin" name="dugmeLogin" class="btn btn-big btn-primary">Log in</button>
                </div>
                <div class="text-danger font-bold" >
                    <?php
                    if (isset($_SESSION["errors"])) {
                        foreach ($_SESSION["errors"] as $se) {
                            echo $se;
                        }
                        unset($_SESSION["errors"]);
                    }
                    ?>
                </div>
            </form>
        </section>
    </main>
</div>