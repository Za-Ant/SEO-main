<?php
require('../Database.php');
$db =  new Database();
if(isset($_POST['contact_us'])){
 
    $data = [
        'contact_name' => $_POST["contact_name"],
        'contact_email' => $_POST["contact_email"],
        'contact_message' => $_POST["contact_message"],
    ];
    try{
        $query = "INSERT INTO contact (contact_name, contact_email,contact_message) VALUES (:contact_name, :contact_email,:contact_message)";
        $query_run = $db->conn->prepare($query);
        $query_run->execute($data);
    }catch(PDOException $e){
        print_r($e->getMessage());
    }   
}else{
    print_r("F");
}
?>