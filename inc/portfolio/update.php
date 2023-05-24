<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('../Database.php');
    try {
        $db = new Database();
        if (!empty($_POST["update_only_name"])) {
            $data = [
                'id' => $_POST["portfolio_id"],
                'name' => $_POST["meno"],
            ];
            $query = "UPDATE portfolio SET name=:name WHERE id=:id";
        } else {
            $data = [
                'id' => $_POST["portfolio_id"],
                'name' => $_POST["meno"],
                'image' => $_POST["image"],
            ];
            $query = "UPDATE portfolio SET name=:name, image=:image WHERE id=:id";
        }
        $query_run = $db->conn->prepare($query);
        $query_run->execute($data);
        header("Location: ../../admin.php");
        exit(0);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    print_r("F");
}