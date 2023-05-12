<?php
require('../config.php');
$portfolio = $Portfolio->get_portfolio();
$db =  new Database();
if(isset($_POST['update_portfolio'])){

    $data = [
        'id' => $_POST["portfolio_id"],
        'update_nazov' => $_POST["update_nazov"],
        
    ];
    foreach ($portfolio as $q){
        if($q->id==$data['id']){
            if(empty($data['update_nazov'])){
                $data['update_nazov'] = $q->name;
            }
        }
    }
    try{
        $query =  "UPDATE portfolio SET name=:update_nazov WHERE id=:id";
        $query_run = $db->conn->prepare($query);
        $query_run->execute($data);
        if(isset($_SERVER['HTTP_REFFERER'])){
            header("Location: {$_SERVER['HTTP_REFFERER']}");
        }else{
            header("Location: ../../admin.php");
        }
        

    }catch(PDOException $e){
        echo $e->getMessage();
    }
    
}else{
    print_r("F");
}
?>