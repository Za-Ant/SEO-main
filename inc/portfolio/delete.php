<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('../Database.php');
    $db = new Database();
    try {
        $data = array(
            ':id' => $_POST["portfolio_id"]
        );
        $stmt = $db->conn->prepare('DELETE FROM portfolio WHERE id=:id');
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