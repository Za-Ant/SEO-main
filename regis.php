<?php
require_once('inc/config.php');
include('components/header.php');
?>
<main>

    <section class="container">
        <div class="row">
            <div class="col-100">
                <h1>Registrácia</h1>
                <form action="inc/register/insert.php" method="post">
                    <input class="form-control" type="text" name="user_name" placeholder="Vaše meno"><br>
                    <input class="form-control" type="email" name="user_email" placeholder="Váš email"><br>
                    <input class="form-control" type="password" name="user_password" placeholder="Vaše heslo"><br>
                    <button class="btn btn-primary" type="submit" name="add_user">Zaregistrovať sa</button>
                </form>
                <br>
                <p>Máte účet? <a href="admin.php">Prihláste sa</a></p>
            </div>
        </div>
    </section>
</main>
<?php
include('components/footer.php');