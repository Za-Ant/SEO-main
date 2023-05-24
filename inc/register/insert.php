<?php
require('../config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $users = $User->get_users();
    $found = false;

    $data = [
        'user_name' => $_POST["user_name"],
        'user_email' => $_POST["user_email"],
        'user_password' => md5($_POST["user_password"])
    ];

    if (empty($data["user_name"]) || empty($data["user_email"]) || empty($data["user_password"])) {
        $msg = 'Všetky polia musia byť vyplnené';
    } else {
        foreach ($users as $user) {
            if ($user->user_email == $data['user_email']) {
                $found = true;
            }
        }
        if ($found == false) {
            try {
                $query = "INSERT INTO users (user_name, user_email, user_password) VALUES (:user_name, :user_email,:user_password)";
                $query_run = $db->conn->prepare($query);
                $query_run->execute($data);
                $msg = "Registrácia dokončená";
            } catch (PDOException $e) {
                $msg = $e->getMessage();
            }
        } else {
            $msg = 'user existuje';
        }
    }
} else {
    header("Location: ../../contact.php");
    exit(0);
}
$relative_path="../../";
include('../../components/header.php');
?>

    <main>
        <section class="container">
            <?= $msg ?>
        </section>
    </main>
<?php
include('../../components/footer.php');