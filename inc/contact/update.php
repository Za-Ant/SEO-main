<?php
    require('../config.php');
    $contact = $Contact->get_contact();
    $db =  new Database();
    if (isset($_POST['update_contact'])) {
        $data = [
            'id' => $_POST["contact_id"],
            'update_meno' => $_POST["update_meno"],
            'update_email' => $_POST["update_email"],
            'update_message' => $_POST["update_message"],  
        ];
        foreach ($contact as $c) {
            if ($c->id==$data['id']) {
                if (empty($data['update_meno'])) {
                    $data['update_meno'] = $c->name;
                } else if (empty($data['update_email'])) {
                    $data['update_email'] = $c->name;
                } else if (empty($data['update_message'])) {
                    $data['update_message'] = $c->name;
                }
            }
        }
        try {
            $query =  "UPDATE contact SET contact_name=:update_meno, contact_email=:update_email, contact_message=:update_message WHERE id=:id";
            $query_run = $db->conn->prepare($query);
            $query_run->execute($data);
            if (isset($_SERVER['HTTP_REFFERER'])) {
                header("Location: {$_SERVER['HTTP_REFFERER']}");
            } else {
                header("Location: ../../admin.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }   
    } else {
        print_r("F");
    }
?>