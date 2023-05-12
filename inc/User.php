<?php
//require('Database.php');
$db =  new Database();
if(isset($_POST['delete_portfolio'])){
    try{
        $id = $_POST["delete_portfolio"];
        $sql = $sql = 'DELETE FROM portfolio WHERE id ='.$id;
        $db->conn->exec($sql);
    }catch(PDOException $e){
        print_r($e->getMessage());
    }
    
}
?>