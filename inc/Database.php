<?php
    class Database
    {
        public $conn;
        function __construct()
        {
            try{
                $this->conn = new PDO('mysql:host=localhost;dbname=seo','root','');
                //$this->conn = new PDO('mysql:host=localhost;dbname=seo;charset=utf8mb4_slovak_ci','root','');
            }catch(PDOException $e){
                var_dump($e->getMessage());
            }
        }
    }
    $db = new Database();
?>