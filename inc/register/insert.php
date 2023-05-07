<?php
require('../config.php');

$db =  new Database();
$users = $User->get_users();
$found = false;

if(isset($_POST['add_user'])){
   
    $data = [
        'user_name' => $_POST["user_name"],
        'user_email' => $_POST["user_email"],
        'user_password' => md5($_POST["user_password"])
    ];
    
    if(empty($data["user_name"])|| empty($data["user_email"]) || empty($data["user_password"])){
        echo 'Všetky polia musia byť vyplnené';
    }else{
        foreach($users as $user){
            if($user->user_email==$data['user_email']){
                $found =  true;
            }
        }
        if($found==false){
            try{
                $query = "INSERT INTO users (user_name, user_email, user_password) VALUES (:user_name, :user_email,:user_password)";
                $query_run = $db->conn->prepare($query);        
                $query_run->execute($data);
                header("Location: ../../thankyou.php");
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }else{
            echo 'user existuje';
        }
    }


}
else{

}
?>