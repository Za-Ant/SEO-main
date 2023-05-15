<?php

    class User
    {
        public $db;
        function __construct()
        {
            $this->db = new Database();
        }
        function get_users() 
        {
            try {
                $query =  $this->db->conn->query("SELECT * FROM users");
                $users = $query->fetchAll(PDO::FETCH_OBJ);
                return $users;
            } catch (PDOException $e) {
                print_r($e->getMessage());
            }   
        }
    }
    $User = new User(); 
?>