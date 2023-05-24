<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('../Database.php');
    $db = new Database();
    $data = [
        'id' => $_POST["contact_id"],
        'contact_name' => $_POST["update_meno"],
        'contact_email' => $_POST["update_email"],
        'contact_message' => $_POST["update_message"],
    ];
    try {
        $query = "UPDATE contact SET contact_name=:contact_name, contact_email=:contact_email, contact_message=:contact_message WHERE id=:id";
        $query_run = $db->conn->prepare($query);
        $query_run->execute($data);
        header("Location: ../../admin.php");
        exit(0);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    header("Location: ../../admin.php");
    exit(0);
}