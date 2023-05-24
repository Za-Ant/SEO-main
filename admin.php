<?php
session_start();
require_once('inc/config.php');//pripojí súbor raz, aj keď sa pokúša pripojiť súbor niekoľkokrát
include('components/header.php');
$admin = false;
$db = new Database();
if (isset($_SESSION['user_email']) && isset($_SESSION['user_password']) && $_COOKIE[session_name()] == session_id()) {
    $login = $_SESSION['user_email'];
    $password = $_SESSION['user_password'];
    $data = [
        ':user_email' => $login,
        ':user_password' => $password,
    ];
    $obj = $db->conn->prepare("SELECT * FROM users WHERE user_email=:user_email AND user_password=:user_password LIMIT 1");
    $obj->execute($data);
    $result = $obj->fetchAll(PDO::FETCH_ASSOC); //načítanie ďalšieho riadku odpovede na dotaz SQL
    if ($login == $result[0]['user_email'] && $password == $result[0]['user_password']) {
        $admin = true;
    } else {
        $err_msg = "Not correct a session auth data!";
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["user_email"]) && isset($_POST["user_password"])) { //či je premenná inicializovaná
    $login = $_POST["user_email"];
    $password = $_POST["user_password"];
    $data = array(
        ':user_email' => $login,
    );
    $obj = $db->conn->prepare("SELECT * FROM users WHERE user_email=:user_email LIMIT 1");
    $obj->execute($data); //Spustí pripravenú žiadosť o vykonanie
    $result = $obj->fetchAll(PDO::FETCH_ASSOC);
    if ((count($result) > 0) && $login == $result[0]['user_email'] && $result[0]['user_password'] == md5($password)) {
        $_SESSION['user_email'] = $login;
        $_SESSION['user_password'] = $result[0]['user_password'];
        header("Location: admin.php");
        exit(0);
    } else {
        $err_msg = "wrong login or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title><?= (!$admin ? "Admin auth" : "Admin rozhranie") ?></title>
</head>
<body>
<?php
include('components/adhead.php');
?>
<main class="container">
<?php if (!$admin) { ?>
    <section>
        <h1>Admin auth</h1>
        <?php
        if (!empty($err_msg)) echo "<p>$err_msg</p>";
        ?>
        <form action="admin.php" method="post">
            <p><label>Name:</label><input class="form-control" type="text" name="user_email"></p>
            <p><label>Password:</label><input class="form-control" type="password" name="user_password"></p>
            <p>
                <button class="btn btn-primary" type="submit">Login</button>
            </p>
        </form>
    </section>

    <?php
// шаблон формы
} else {
    ?>
    <section>
            <h2 align="center">Vítaj <?php echo($_SESSION['user_email']); ?></h2>
            <h3 align="center">Admin rozhranie</h3>
        <h2>Portfólio</h2>
        <form class="mb-3 row" action="inc/portfolio/insert.php" method="post">
            <div class="col-auto"><input class="form-control" type="text" name="meno" id="name"
                                         placeholder="Názov portfólia"></div>
            <div class="col-auto"><input class="form-control" type="text" name="image" id="image"
                                         placeholder="Cesta k obrázku"></div>
            <div class="col-auto"><input class="btn btn-sm btn-outline-success" type="submit" value="Pridať"
                                         name="add_portfolio"></div>
        </form>
        <?php $portfolio = $Portfolio->get_portfolio(); ?>
        <table class="table admin-table">
            <tr>
                <th>Meno</th>
                <th>Image</th>
                <th>Editovat</th>
                <th>Vymazať</th>
            </tr>
            <?php foreach ($portfolio as $p): ?>
                <tr>
                    <form action="inc/portfolio/update.php" method="post">
                        <input type="hidden" name="portfolio_id" value="<?= $p->id ?>">
                        <td><input class="form-control" name="meno" type="text" value="<?= $p->name ?>"></td>
                        <td><input class="form-control" name="image" type="text" value="<?= $p->image ?>"></td>
                        <td><input class="btn btn-sm btn-outline-primary" type="submit" name="update_portfolio"
                                   value="Editovat"></td>
                    </form>
                    <form action="inc/portfolio//delete.php" method="post">
                        <td>
                            <input type="hidden" name="portfolio_id" value="<?= $p->id ?>">
                            <input class="btn btn-sm btn-outline-danger" type="submit" name="delete_portfolio"
                                   value="Vymazať">
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
    <section>
        <h2>Kontakty</h2>
        <form class="mb-3 row"
        action="inc/contact/insert.php" method="post">
        <div class="col-auto"><input class="form-control" type="text" name="contact_name" id="name" placeholder="Name">
        </div>
        <div class="col-auto"><input class="form-control" type="text" name="contact_email" id="email"
                                     placeholder="Email"></div>
        <div class="col-auto"><input class="form-control" type="text" name="contact_message" id="message"
                                     placeholder="Message"></div>
        <div class="col-auto"><input class="btn btn-sm btn-outline-success" type="submit" value="Pridať"
                                     name="add_contact"></div>
        </form>
        <?php $contact = $Contact->get_contact(); ?>
        <table class="table admin-table">
            <tr>
                <th>Meno</th>
                <th>Email</th>
                <th>Text</th>
                <th>Editovat</th>
                <th>Vymazať</th>
            </tr>
            <?php foreach ($contact as $c): ?>
                <tr>
                    <form action="inc/contact/update.php" method="post">
                        <input type="hidden" name="contact_id" value="<?= $c->id ?>">
                        <td><input class="form-control" type="text" placeholder="zmena mena" name="update_meno"
                                   value="<?= $c->contact_name ?>"></td>
                        <td><input class="form-control" type="text" placeholder="zmena email" name="update_email"
                                   value="<?= $c->contact_email ?>"></td>
                        <td><input class="form-control" type="text" placeholder="zmena message" name="update_message"
                                   value="<?= $c->contact_message ?>"></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" type="submit" name="update_contact"
                                    value="<?= $c->id ?>">Editovať
                            </button>
                        </td>
                    </form>
                    <form action="inc/contact//delete.php" method="post">
                        <input type="hidden" name="contact_id" value="<?= $c->id ?>">
                        <td>
                            <button class="btn btn-sm btn-outline-danger" type="submit" name="delete_contact">Vymazať
                            </button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
    <span>
        <a class="btn btn-sm btn-outline-primary" role="button" href="inc/login/logout.php">Odhlásiť sa</a></h2>
    </span>
    <?php
}
?>
</main>
<script src="/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>