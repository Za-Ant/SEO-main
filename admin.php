<?php
    require_once('inc/config.php');
    session_start();
    $admin = false;
    $db;
    if (isset($_SESSION['user_email'])&&isset($_SESSION['user_password'])&&$_COOKIE[session_name()] == session_id()) {
       
        $login = $_SESSION['user_email'];
        $password = $_SESSION['user_password'];
        $data = [
            ':user_email' => $login, //тернарный оператор(сокращение иф)
            ':user_password' => $password,
        ];
        $obj = $db->conn->prepare("SELECT * FROM users WHERE user_email=:user_email AND user_password=:user_password LIMIT 1");
        $obj->execute($data);
        $result = $obj->fetchAll();
        if($login == $result[0]['user_email'] && $password == $result[0]['user_password']) {
            $admin = true;
        } else {
            $err_msg = "Not correct a session auth data!";
        }
    } else if (isset($_POST["user_email"])&&isset($_POST["user_password"])) {
        $login = $_POST["user_email"];
        $password = $_POST["user_password"];
        $data = array(
            ':user_email' => $login, //тернарный оператор(сокращение иф)
        );
        $obj = $db->conn->prepare("SELECT * FROM users WHERE user_email=:user_email LIMIT 1");
        $obj->execute($data);
        $result = $obj->fetchAll();
        if((count($result)>0) && $login == $result[0]['user_email'] && $result[0]['user_password']==md5($password)) {
            $_SESSION['user_email'] = $login;
            $_SESSION['user_password'] = $result[0]['user_password'];
            header("Location: admin.php");
            exit(0);
        }
        else {
            $err_msg ="wrong login or password!";
        }
    }
    // } else {
    //     $err_msg = "попытка входа с неверными учетными данными или истек срок сессии";
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body class="container">

<?php if(!$admin) { ?>
    <section>
        <h1>Admin auth</h1>
        <?php
        if(!empty($err_msg)) echo "<p>$err_msg</p>";
        ?>
        <form action="admin.php" method="post">
            <p><label>Name:</label><input type="text" name="user_email"></p>
            <p><label>Password:</label><input type="password" name="user_password"></p>
            <p><button type="submit">Login</button></p>
        </form>
    </section>
<?php
// шаблон формы
} else {
?>
    <section>
        <h1>Admin rozhranie</h1>
        <p>Vítaj admin <?php echo($_SESSION['user_email']);?></p><br>
        <a href="inc/login/logout.php">Odhlásiť sa</a>
    </section>
    <section>
        <h2>Portfólio</h2>
        <form action="inc/portfolio/insert.php" method="post">
            <input type="text" name="name" id="name" placeholder="Názov portfólia">
            <input type="text" name="image" id="image" placeholder="Cesta k obrázku">
            <input type="submit" value="Pridať" name="add_portfolio">
        </form>
        <?php
            $portfolio = $Portfolio->get_portfolio();
            echo '<table class="admin-table">';
                foreach($portfolio as $p){
                    echo '<tr>';
                    echo '<td>'.$p->name;'</td>';
                    echo '<td>'.'<img width="150" src = "'.$p->image.'">';
                    echo '<td>
                            <form action="inc/portfolio/update.php" method="post">
                                <input type="hidden" name="portfolio_id" value="'.$p->id.'"'.' >
                                <input type="text" placeholder ="zmen nazov" name="update_nazov">
                                <button type = "submit" name="update_portfolio" '.'>Editovat</button>
                            </form>';

                    echo '<td>
                            <form action="inc/portfolio//delete.php" method="post">
                                <button type = "submit" name="delete_portfolio" value="'.$p->id.'"'.'>Vymazať</button>
                            </form>';
                    echo '</tr>';
                }
                echo '</table>';
        ?>
    </section>
    <!-- <section>
        <h2>Qna</h2>
        <form action="inc/qna/insert.php" method="post">
            <input type="text" name="question" placeholder="Názov otázky">
            <input type="text" name="answer"placeholder="Názov odpovede">
            <input type="submit" value="Pridať" name="add_qna">
        </form>
        <?php
            $qna = $Qna->get_qna();
            
            echo '<table class="admin-table">';
                foreach($qna as $q){
                    echo '<tr>';
                    echo '<td>'.$q->question;'</td>';
                    echo '<td>'.$q->answer;'</td>';
                    echo '<td>
                            <form action="inc/qna/delete.php" method="post">
                                <button type = "submit" name="delete_qna" value="'.$q->id.'"'.'>Vymazať</button>
                            </form>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td colspan="4">
                            <form action="inc/qna/update.php" method="post">
                                <input type="hidden" name="form_id" value="'.$q->id.'"'.'>
                                <input type ="text" name="update_question" placeholder="Text otázky"><br>
                                <input type ="text" name="update_answer" placeholder = "Text odpovede"><br>
                                <input type ="submit" name="update_qna" value="Zmeň text">
                            </form>
                        </td>'; 
                    echo '</tr>';
                }
                echo '</table>';
        ?>
    </section> -->
    <section>
        <h2>Kontakty</h2>
        <form action="inc/contact/insert.php" method="post">
            <input type="text" name="name" id="name" placeholder="Name">
            <input type="text" name="image" id="image" placeholder="Email">
            <input type="submit" value="Pridať" name="add_contact">
        </form>
        <?php
            $contact = $Contact->get_contact();
            echo '<table class="admin-table">';
                foreach($contact as $c){
                    echo '<tr>';
                    echo '<td>'.$c->contact_name;'</td>';
                    echo '<td>'.$c->contact_email;'</td>';
                    echo '<td>'.$c->contact_message;'</td>';
                    echo '<td>
                            <form action="inc/contact/update.php" method="post">
                                <input type="hidden" name="contact_id" value="'.$c->id.'"'.' >
                                <input type="text" placeholder ="zmena mena" name="update_meno">
                                
                                <button type = "submit" name="update_contact" '.'>Editovat</button>
                            </form>';

                    echo '<td>
                            <form action="inc/contact//delete.php" method="post">
                                <button type = "submit" name="delete_contact" value="'.$c->id.'"'.'>Vymazať</button>
                            </form>';
                    echo '</tr>';
                    
                }
                echo '</table>';
        ?>
    </section>
    
<?php
}
?>
</body>
</html>