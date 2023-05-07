<?php
    require('inc/config.php');
    session_start();
    if(!isset($_SESSION['user_name'])){
        header("Location:no-permission.php");
    }
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
    <section>
        <h1>Admin rozhranie</h1>
        <p>Vítaj admin <?php echo($_SESSION['user_name']);?></p><br>
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
                    echo '<td><button class="edit">Editovať</button>';
                    echo '<td>
                            <form action="inc/portfolio//delete.php" method="post">
                                <button type = "submit" name="delete_portfolio" value="'.$p->id.'"'.'>Vymazať</button>
                            </form>';
                    echo '</tr>';
                }
                echo '</table>';
        ?>
    </section>
    <section>
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
    </section>
    <section>
        <h2>Kontakty</h2>
        <?php
            $contact = $Contact->get_contact();
            echo '<table class="admin-table">';
                foreach($contact as $c){
                    echo '<tr>';
                    echo '<td>'.$c->contact_name;'</td>';
                    echo '<td>'.$c->contact_email;'</td>';
                    echo '<td>'.$c->contact_message;'</td>';
                    echo '<td>
                            <form action="inc/contact/edit.php" method="post">
                                <button type = "submit" name="edit_contact" value="'.$c->id.'"'.'>Editovať</button>
                            </form></td>';
                    echo '<td>
                            <form action="inc/contact/delete.php" method="post">
                                <button type = "submit" name="delete_contact" value="'.$c->id.'"'.'>Vymazať</button>
                            </form></td>';
                    echo '</tr>';
                }
                echo '</table>';
        ?>
    </section>
    
</body>
</html>