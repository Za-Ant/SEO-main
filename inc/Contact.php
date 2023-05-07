<?php
    
    class Contact{
        public $db;
        function __construct()
        {
            $this->db = new Database();
        }
        function get_contact(){
            try{
                $query =  $this->db->conn->query("SELECT * FROM contact");
                $contact = $query->fetchAll(PDO::FETCH_OBJ);
                return $contact;

              }catch(PDOException $e){
                print_r($e->getMessage());
            }   
        }
    }
    $Contact = new Contact();
    
?>