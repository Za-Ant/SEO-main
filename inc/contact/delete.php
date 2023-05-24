<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('../Database.php');
    $db = new Database();
    try {
        $data = array(
            ':id' => $_POST["contact_id"]
        );
        $stmt = $db->conn->prepare('DELETE FROM contact WHERE id=:id');
        $stmt->execute($data);
        header("Location: ../../../admin.php");
        exit(0);
    } catch (PDOException $e) {
        print_r($e->getMessage());
    }
} else {
    header("Location: ../../../admin.php");
    exit(0);
}