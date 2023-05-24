<?php
require('../Database.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $db = new Database();
    $data = [
        ':name' => $_POST["meno"],
        ':image' => $_POST["image"],
    ];
    $query = "INSERT INTO portfolio (name, image) VALUES (:name, :image)";
    $query_run = $db->conn->prepare($query);
    $query_run->execute($data);
    header("Location: ../../admin.php");
    exit(0);
} else {
    print_r("F");
}

?>