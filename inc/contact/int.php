<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
require_once('../Database.php');
$db = new Database();
    $data = [
        'contact_name' => $_POST["contact_name"],
        'contact_email' => $_POST["contact_email"],
        'contact_message' => $_POST["contact_message"],
    ];
    try {
        $query = "INSERT INTO contact (contact_name, contact_email,contact_message) VALUES (:contact_name, :contact_email,:contact_message)";
        $query_run = $db->conn->prepare($query);
        $query_run->execute($data);
        header("Location: ../../thanks.php");
        exit(0);
    } catch (PDOException $e) {
        print_r($e->getMessage());
    }
} else {
    header("Location: ../../contact.php");
    exit(0);
}